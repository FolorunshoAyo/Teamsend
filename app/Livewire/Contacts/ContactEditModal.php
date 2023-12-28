<?php

namespace App\Livewire\Contacts;

use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Rules\UniqueEmailInOrganisationContacts;
use App\Rules\UniquePhoneNoInOrganisationContacts;

class ContactEditModal extends Component
{
    public $contact;
    public $org_id;
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

    public function mount($contact, $orgId)
    {
        $this->org_id = $orgId;
        $this->contact = $contact; // ID of contact

        $this->first_name = $this->contact->first_name;
        $this->last_name = $this->contact->last_name;
        $this->email = $this->contact->email;
        $this->country_code = $this->contact->country_code;
        $this->phone = $this->contact->phone;
    }

    public function rules(){
        return [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => [
                'required',
                'email',
                new UniqueEmailInOrganisationContacts($this->org_id, $this->contact->id)
            ],
            'country_code' => 'required',
            'phone' => [
                'required',
                'max:20',
                new UniquePhoneNoInOrganisationContacts($this->org_id, $this->country_code, $this->contact->id)
            ],
        ];
    }
    
    public function updateContact()
    {   
        $validatedData = $this->validate();

        $this->contact->first_name = $validatedData['first_name']; 
        $this->contact->last_name = $validatedData['last_name']; 
        $this->contact->email = $validatedData['email']; 
        $this->contact->country_code = $validatedData['country_code']; 
        $this->contact->phone = $validatedData['phone'];

        $this->contact->save();

        $this->dispatch('contactUpdated');
        $this->dispatch("tableSuccess", message: "Contact updated successfully");
    }

    public function closeModal()
    {
        $this->dispatch('contactUpdated');
    }

    public function render()
    {
        return view('livewire.contacts.contact-edit-modal');
    }
}
