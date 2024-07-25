<?php

namespace App\Livewire\Contacts;

use App\Models\Contact;
use Livewire\Component;
use App\Models\Organisation;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class ContactsDataTable extends Component
{
    use WithPagination;
    
    public $modalVisible = false;
    public $createModalVisible = false;
    public $perPage = 10;
    public $search = '';
    public $selectAll = false;
    public $selected = [];
    public $selectedContact;
    public $user_id;
    public $is_blocked = "0";
    public $is_favourite = "0";
    public $is_trashed = "0";
    public $activeFilter = null;
    public $org_id; 
    public $isLoading = true;

    public function mount($orgId){
        $this->org_id = $orgId;
        $this->user_id = Auth::user()->id;
    }

    // public function updateSelectedContacts(){
    //     dd($this->selected);
    // }

    // public function updatedPage($page)
    // {
    //     // dd($page);
    //     $this->selected = $this->selected;
    // }

    protected $listeners = [
        'contactUpdated' => 'refreshTable'
    ];

    public function render()
    {
        $orgId = $this->org_id;
        $searchTerm = $this->search;

        $contacts = "";         

        $this->isLoading = true;

        if($this->activeFilter === null){
            // Query to get all contacts
            $contacts = Contact::whereHas('userOrganisation', function ($query) use ($orgId) {
                $query->where('org_id', $orgId);
            })
            ->where(function ($query) use ($searchTerm) {
                $query->where('first_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('last_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('email', 'like', '%' . $searchTerm . '%');
            })
            ->with('userOrganisation.user')
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);

            $this->isLoading = false;
        }elseif($this->activeFilter === "favourite"){
            // Query to get favourite contacts
            $contacts = Contact::whereHas('userOrganisation', function ($query) use ($orgId) {
                $query->where('org_id', $orgId);
            })
            ->where(function ($query) use ($searchTerm) {
                $query->where('first_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('last_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('email', 'like', '%' . $searchTerm . '%');
            })
            ->where('is_favourite', $this->is_favourite)
            ->with('userOrganisation.user')
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);

            $this->isLoading = false;
        }elseif($this->activeFilter === "blocked"){
            // Query to get blocked contacts
            $contacts = Contact::whereHas('userOrganisation', function ($query) use ($orgId) {
                $query->where('org_id', $orgId);
            })
            ->where(function ($query) use ($searchTerm) {
                $query->where('first_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('last_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('email', 'like', '%' . $searchTerm . '%');
            })
            ->where('is_blocked', $this->is_blocked)
            ->with('userOrganisation.user')
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);

            $this->isLoading = false;
        }else{
            // Query to get trashed contacts
            $contacts = Contact::whereHas('userOrganisation', function ($query) use ($orgId) {
                $query->where('org_id', $orgId);
            })
            ->where(function ($query) use ($searchTerm) {
                $query->where('first_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('last_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('email', 'like', '%' . $searchTerm . '%');
            })
            ->where('is_trashed', $this->is_trashed)
            ->with('userOrganisation.user')
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);

            $this->isLoading = false;
        }

        return view('livewire.contacts.contacts-data-table', [
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


    public function toggleSelected()
    {
        $orgId = $this->org_id;
        
        $arrayOfContacts = Contact::whereHas('userOrganisation', function ($query) use ($orgId) {
            $query->where('org_id', $orgId);
        })
        ->with('userOrganisation.user')
        ->orderBy('created_at', 'desc')
        ->pluck('id')
        ->map(function ($id) {
            return (string) $id;
        })
        ->toArray();

        $this->updateDataTableState($arrayOfContacts);
    }

    public function updateDataTableState($contacts){
        if(count($this->selected) === 0){
            $this->selectAll = false;
        }else{
            sort($this->selected);
            sort($contacts);

            if (empty(array_diff($this->selected, $contacts)) && empty(array_diff($contacts, $this->selected))) {
                $this->selectAll = true;
            }else{
                $this->selectAll = false;
            }
        }

        if($this->selectAll === true){
            $this->selected = $contacts;
        }
    }

    public function toggleSelectAll(){
        $this->selectAll = !$this->selectAll;

        $orgId = $this->org_id;
        
        $arrayOfContacts = Contact::whereHas('userOrganisation', function ($query) use ($orgId) {
            $query->where('org_id', $orgId);
        })
        ->with('userOrganisation.user')
        ->orderBy('created_at', 'desc')
        ->pluck('id')
        ->map(function ($id) {
            return (string) $id;
        })
        ->toArray();

        if($this->selectAll === true){
            $this->selected = $arrayOfContacts;
        } else {
            $this->selected = [];
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

    public function addSelectedTo($destination){
        // $this->dispatch("actionDoneOnDataTable");

        $column_to_update = "is_$destination";

        if($column_to_update === "is_favourite" || $column_to_update === "is_trashed" || $column_to_update === "is_blocked"){
            
            if(count($this->selected) > 0){
                foreach ($this->selected as $contactId) {
                    $orgId = $this->org_id;
        
                    $contact = Contact::whereHas('userOrganisation', function ($query) use ($orgId) {
                        $query->where('org_id', $orgId);
                    })
                    ->where('id', $contactId)
                    ->first();
                
                    if ($contact) {
                        $contact[$column_to_update] = "1";

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
        }else{
            return;
        }
    }

    public function removeSelectedFrom($destination){   
        // $this->dispatch("actionDoneOnDataTable");

        $column_to_update = "is_$destination";

        if($column_to_update === "is_favourite" || $column_to_update === "is_trashed" || $column_to_update === "is_blocked"){
            if(count($this->selected) > 0){
                foreach ($this->selected as $contactId) {
                    $orgId = $this->org_id;
        
                    $contact = Contact::whereHas('userOrganisation', function ($query) use ($orgId) {
                        $query->where('org_id', $orgId);
                    })
                    ->where('id', $contactId)
                    ->first();
                
                    if ($contact) {
                        $contact[$column_to_update] = "0";

                        $contact->save();
                    }else{
                        return;
                    }
                }

                $this->refreshTable();
                $this->dispatch("tableSuccess", message: "Selected contacts removed to favourites");
            }else{
                $this->dispatch("tableError", message: "No selection was made");
            }
        }else{
            return;
        }
    }

    public function openContactEditModal($contact)
    {
        $this->selectedContact = Contact::find($contact);
        $this->modalVisible = true;
    }

    public function closeModal()
    {
        $this->modalVisible = false;
    }

    public function refreshTable()
    {
        $this->modalVisible = false;
        $this->createModalVisible = false;
    }

    // public function refresh()
    // {
    //     $query = SampleModel::where('name', 'like', "%$this->search%")
    //         ->orWhere('email', 'like', "%$this->search%");

    //     if ($this->selectAll) {
    //         $this->selectedSamples = $query->pluck('id')->toArray();
    //     }

    //     $this->sampleData = $query->paginate($this->perPage);
    // }

    public function createContact()
    {
        $this->createModalVisible = true;
    }

    public function applyFilter($status)
    {
        if($status === "blocked"){
            $this->is_blocked = "1";
            $this->activeFilter = "blocked";
        }elseif($status === "favourite"){
            $this->is_favourite = "1";
            $this->activeFilter = "favourite";
        }else{
            $this->is_trashed = "1";
            $this->activeFilter = "trashed";
        }
    }

    public function clearFilter()
    {
        $this->is_blocked = "0";
        $this->is_favourite = "0";
        $this->is_trashed = "0";
        $this->activeFilter = null;
    }
}
