<?php

namespace App\Livewire\Groups;

use App\Models\Lists;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class GroupsDataTable extends Component
{
    use WithPagination;
    
    public $deleteModalConfirmationVisible = false;
    public $perPage = 10; // Default items per page
    public $search = '';
    public $org_id; 
    public $org_name; 
    public $user_id;

    protected $listeners = ['agentUpdated' => 'refreshTable'];

    public function mount($orgId, $orgName){
        $this->org_id = $orgId;
        $this->org_name = $orgName;
        $this->user_id = Auth::user()->id;
    }

    public function render()
    {
        $orgId = $this->org_id;
        $searchTerm = $this->search;

        $lists = Lists::select('lists.*')
        ->addSelect(DB::raw('(SELECT COUNT(*) FROM list_contacts WHERE list_contacts.list_id = lists.id) as contact_count'))
        ->whereHas('userOrganisation', function ($query) use ($orgId) {
            $query->where('org_id', $orgId);
        })
        ->where(function ($query) use ($searchTerm) {
            $query->where('list_name', 'like', '%' . $searchTerm . '%')
                ->orWhere('list_description', 'like', '%' . $searchTerm . '%');
        })
        ->with(['userOrganisation.user'])
        ->orderBy('created_at', 'desc')
        ->paginate($this->perPage);

        return view('livewire.groups.groups-data-table', [
            'groups' => $lists
        ]);
    }

    public function refreshTable()
    {
        $this->deleteModalConfirmationVisible = false;
    }

}
