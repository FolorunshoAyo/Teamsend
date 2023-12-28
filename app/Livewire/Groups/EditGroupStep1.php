<?php

namespace App\Livewire\Groups;

use Livewire\Component;

class EditGroupStep1 extends Component
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
        $this->name = $formData['name'];
        $this->description = $formData['description'];
        $this->active = $formData['active'];
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
        return view('livewire.groups.edit-group-step1');
    }
}
