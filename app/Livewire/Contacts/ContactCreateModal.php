<?php

namespace App\Livewire\Contacts;

use App\Models\Contact;
use Livewire\Component;
use App\Models\UserOrganisation;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use App\Rules\UniqueEmailInOrganisationContacts;

class ContactCreateModal extends Component
{
    #[Validate]
    public $first_name;
    #[Validate]
    public $last_name;
    #[Validate]
    public $email;
    #[Validate]
    public $country_code;
    #[Validate]
    public $phone;
    public $org_id; 

    public function mount($orgId){
        $this->org_id = $orgId;
    }

    public function rules(){
        return [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => [
                'required',
                'email',
                new UniqueEmailInOrganisationContacts($this->org_id)
            ],
            'phone' => 'required|max:20',
            'country_code' => 'required',
        ];
    }

    public function createContact()
    {
        $this->validate();

        $user = Auth::user();

        $user_org_id = UserOrganisation::where('user_id', $user->id)
        ->where('org_id', $this->org_id)
        ->first();

        Contact::create([
            'user_org_id' => $user_org_id->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'country_code' => $this->country_code,
        ]);

        $this->dispatch('contactUpdated');
        $this->dispatch("tableSuccess", message: "New contact added successfully");

        $this->reset();
    }

    public function closeModal()
    {
        $this->dispatch('contactUpdated');
    }
    
    public function render()
    {
        return view('livewire.contacts.contact-create-modal');
    }
}
