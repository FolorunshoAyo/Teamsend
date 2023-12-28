<?php

namespace App\Livewire\Groups;

use Carbon\Carbon;
use App\Models\Lists;
use App\Models\Contact;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ViewGroup extends Component
{
    public $modalVisible = false;
    public $perPage = 10;
    public $search = '';
    public $selectAll = false;
    public $selectedContacts = [];
    public $selectedContact;
    public $selected_group; 
    public $user_id;
    public $org_id;

    public function mount($orgId, $selectedGroup){
        $this->selected_group = $selectedGroup;
        $this->org_id = $orgId;
        $this->user_id = Auth::user()->id;
    }
    
    public function render()
    {
        // $searchTerm = $this->search;
        $searchTerm = $this->search;
        $listId = $this->selected_group->id;


        $list = Lists::findOrFail($listId);


        $groupContactsQuery = $list->contacts();

        $groupContactsQuery->where(function ($query) use ($searchTerm) {
            $query->orWhere('first_name', 'LIKE', '%' . $searchTerm . '%')
                  ->orWhere('last_name', 'LIKE', '%' . $searchTerm . '%')
                  ->orWhere('email', 'LIKE', '%' . $searchTerm . '%');
        });

        $groupContactsQuery->orderBy('created_at', 'desc');

        $groupContacts = $groupContactsQuery->paginate($this->perPage);
        
        $createdAt = Carbon::parse($this->selected_group['created_at']);

        $createdAt = $createdAt->format('F j, Y h:i A');

        return view('livewire.groups.view-group', [
            'groupContacts' => $groupContacts,
            'groupName' => $this->selected_group['list_name'],
            'groupDesc' => $this->selected_group['list_description'],
            'isActive' => $this->selected_group['active'],
            'createdAt' => $createdAt
        ]);
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

    public function setToFavourite($contactId){
        $orgId = $this->org_id;

        $contact = Contact::whereHas('userOrganisation', function ($query) use ($orgId) {
            $query->where('org_id', $orgId);
        })
        ->where('id', $contactId)
        ->first();

        if($contact){
            if($contact->is_favourite == "1"){
                $contact->is_favourite = "0";

                $this->dispatch("tableSuccess", message: "Contact removed from favourites");
            }else{
                $contact->is_favourite = "1";
                $this->dispatch("tableSuccess", message: "Contact added to favourite");
            } 
    
            $contact->save();
        }else{
            return;
        }

        $this->refreshTable();
    }

    public function refreshTable()
    {
        $this->modalVisible = false;
    }

    public function addSelectedToFavourites(){
        // $this->dispatch("actionDoneOnDataTable");
        if(count($this->selectedContacts) > 0){
            foreach ($this->selectedContacts as $contactId) {
                $orgId = $this->org_id;
    
                $contact = Contact::whereHas('userOrganisation', function ($query) use ($orgId) {
                    $query->where('org_id', $orgId);
                })
                ->where('id', $contactId)
                ->first();
            
                if ($contact) {
                    $contact['is_favourite'] = "1";

                    $contact->save();
                }else{
                    return;
                }
            }

            $this->refreshTable();
            $this->dispatch("tableSuccess", message: "Selected contacts added to favourites");
        }else{
            $this->dispatch("tableError", message: "No selection was made");
        }
    }

    public function removeSelectedFromGroup(){   
        if(count($this->selectedContacts) > 0){

            $this->refreshTable();
            $this->dispatch("tableSuccess", message: "Selected contacts removed from the group");
        }else{
            $this->dispatch("tableError", message: "No selection was made");
        }
    }
}
