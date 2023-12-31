<?php

namespace App\Livewire\Groups;

use App\Models\Contact;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class NewGroupStep2 extends Component
{
    use WithPagination;
    
    public $perPage = 10;
    public $selectAll = false;
    public $selectedContacts = [];
    public $org_id;
    public $user_id;

    public function mount($orgId){
        $this->org_id = $orgId;
        $this->user_id = Auth::user()->id;
    }

    public function render()
    {
        $orgId = $this->org_id;

        $contacts = Contact::whereHas('userOrganisation', function ($query) use ($orgId) {
            $query->where('org_id', $orgId);
        })
        // ->where(function ($query) use ($searchTerm) {
        //     $query->where('first_name', 'like', '%' . $searchTerm . '%')
        //         ->orWhere('last_name', 'like', '%' . $searchTerm . '%')
        //         ->orWhere('email', 'like', '%' . $searchTerm . '%');
        // })
        ->with('userOrganisation.user')
        ->orderBy('created_at', 'desc')
        ->paginate($this->perPage);

        return view('livewire.groups.new-group-step2', [
            'contacts' => $contacts,
            'totalContacts' => $this->totalContacts
        ]);
    }

    public function getTotalContactsProperty(){
        $orgId = $this->org_id;

        return Contact::whereHas('userOrganisation', function ($query) use ($orgId) {
            $query->where('org_id', $orgId);
        })->count();
    }


    public function previousStep()
    {
        // previous step
        $this->dispatch("navigate", step: 1);
    }

    public function toggleSelectedContacts()
    {
        $orgId = $this->org_id;
        
        $arrayOfContacts = Contact::whereHas('userOrganisation', function ($query) use ($orgId) {
            $query->where('org_id', $orgId);
        })
        ->with('userOrganisation.user')
        ->orderBy('created_at', 'desc')
        ->pluck('id')
        ->toArray();

        $this->updateDataTableState($arrayOfContacts);
    }

    public function updateDataTableState($contacts){
        if(count($this->selectedContacts) === 0){
            $this->selectAll = false;
        }else{
            sort($this->selectedContacts);
            sort($contacts);

            if (empty(array_diff($this->selectedContacts, $contacts)) && empty(array_diff($contacts, $this->selectedContacts))) {
                $this->selectAll = true;
            }else{
                $this->selectAll = false;
            }
        }

        if($this->selectAll === true){
            $this->selectedContacts = $contacts;
        }
    }

    public function toggleSelectAll(){
        // $this->dispatch('actionDoneOnDataTable');

        $this->selectAll = !$this->selectAll;

        $orgId = $this->org_id;
        
        $arrayOfContacts = Contact::whereHas('userOrganisation', function ($query) use ($orgId) {
            $query->where('org_id', $orgId);
        })
        ->with('userOrganisation.user')
        ->orderBy('created_at', 'desc')
        ->pluck('id')
        ->toArray();

        if($this->selectAll === true){
            $this->selectedContacts = $arrayOfContacts;
        } else {
            $this->selectedContacts = [];
        }

        $this->updateDataTableState($arrayOfContacts);
    }

    public function createGroup(){
        if(count($this->selectedContacts) > 0){
            $data = [
                'selectedContacts' => $this->selectedContacts
            ];

            $this->dispatch('updateFormData', step: "step2", data: $data);

            $this->dispatch('submitForm');
        }else{
            $this->dispatch("tableError", message: "No selection was made");
            return;
        }
    }
}
