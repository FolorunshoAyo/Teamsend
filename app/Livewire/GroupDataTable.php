<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class GroupDataTable extends Component
{
    use WithPagination;
    
    public $deleteModalConfirmationVisible = false;
    public $perPage = 10; // Default items per page
    public $search = '';

    protected $listeners = ['agentUpdated' => 'refreshTable'];

    public function render()
    {
        $lists = ''; 
        return view('livewire.group-data-table', [
            'groups' => $lists
        ]);
    }

    public function refreshTable()
    {
        $this->deleteModalConfirmationVisible = false;
        $this->dispatch("tableRefreshed");
    }

}
