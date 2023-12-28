<?php

namespace App\Livewire\Agents;

use Livewire\Component;

class AgentEditModal extends Component
{
    public $agent;
    public $active = false;
    public $first_name;
    public $last_name;
    public $email;

    // protected $rules = [
    //     // 'agent.first_name' => 'required|max:255',
    //     // 'agent.last_name' => 'required|max:255',
    //     // 'agent.email' => 'required|email',
    // ];

    public function mount($agent)
    {
        $this->agent = $agent; // ID of agent

        $this->first_name = $this->agent->first_name;
        $this->last_name = $this->agent->last_name;
        $this->email = $this->agent->email;
        $this->active = $this->agent->active;
    }

    public function updateAgent()
    {        
        $this->agent->active = $this->active;

        $this->agent->save();

        $this->dispatch('agentUpdated');
        $this->dispatch('notifyUpdatedAgent');
    }

    public function closeModal()
    {
        $this->dispatch('agentUpdated');
    }

    public function render()
    {
        return view('livewire.agents.agent-edit-modal');
    }
}
