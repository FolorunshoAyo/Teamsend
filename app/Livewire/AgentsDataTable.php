<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Organisation;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class AgentsDataTable extends Component
{
    use WithPagination;

    public $modalVisible = false;
    public $createModalVisible = false;
    public $selectedAgent;
    public $perPage = 10; // Default items per page
    public $search = '';

    protected $listeners = ['agentUpdated' => 'refreshTable'];

    public function render()
    {
        // Refresh with recent updates
        // GET CURRENT USER IN SESSION
        $user = Auth::user();
        // Retrieve organisation details
        $user_id = $user->id;
        $organisation = Organisation::whereHas('userOrganisations', function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        })->first();
        $orgId = $organisation->id;
        $searchTerm = $this->search;

        $paginator = User::whereDoesntHave('userOrganisations', function ($query) use ($orgId) {
            $query->where('org_id', $orgId)
                ->where('is_admin', 1);
        })
        ->where(function ($query) use ($searchTerm) {
            $query->where('first_name', 'like', '%' . $searchTerm . '%')
                ->orWhere('last_name', 'like', '%' . $searchTerm . '%')
                ->orWhere('email', 'like', '%' . $searchTerm . '%');
        })
        ->orderBy('created_at', 'desc')
        ->paginate($this->perPage);

        return view('livewire.agents-data-table', [
            'agentsData' => $paginator
        ]);
    }

    public function openAgentEditModal($agentId)
    {
        $this->selectedAgent = User::find($agentId);
        $this->modalVisible = true;
    }

    public function closeModal()
    {
        $this->modalVisible = false;
        $this->createModalVisible = true;
    }

    public function refreshTable()
    {
        $this->modalVisible = false;
        $this->createModalVisible = false;
        $this->dispatch("tableRefreshed");
    }

    // public function refresh()
    // {
    //     // GET CURRENT USER IN SESSION
    //     $user = Auth::user();
    //     // Retrieve organisation details
    //     $user_id = $user->id;
    //     $organisation = Organisation::whereHas('userOrganisations', function ($query) use ($user_id) {
    //         $query->where('user_id', $user_id);
    //     })->first();
    //     $orgId = $organisation->id;
    //     $searchTerm = $this->search;
    //     $this->agentsData = User::whereDoesntHave('userOrganisations', function ($query) use ($orgId) {
    //         $query->where('org_id', $orgId)
    //             ->where('is_admin', 1);
    //     })
    //     ->where(function ($query) use ($searchTerm) {
    //         $query->where('first_name', 'like', '%' . $searchTerm . '%')
    //             ->orWhere('last_name', 'like', '%' . $searchTerm . '%')
    //             ->orWhere('email', 'like', '%' . $searchTerm . '%');
    //     })
    //     ->orderBy('created_at', 'desc')
    //     ->paginate($this->perPage);
    // }

    public function createAgent()
    {
        $this->createModalVisible = true;
    }
}
