<?php

namespace App\Livewire\Groups;

use Livewire\Component;

class NewGroupStep1 extends Component
{
    public $formData = [];

    public $name;
    public $description;
    public $active;

    protected $rules = [
        'name' => "required|max:255"
    ];

    public function mount($formData)
    {
        $this->formData = $formData;
    }

    public function nextStep()
    {
        $validatedData = $this->validate();

        $this->formData = [
            "name" => $validatedData['name'],
            "description" => $this->description,
            "active" => $this->active
        ];

        // next step
        $this->dispatch("navigate", step: 2);

        $this->dispatch("updateFormData", step: "step1", data: $this->formData);
    }

    public function render()
    {
        return view('livewire.groups.new-group-step1');
    }
}
