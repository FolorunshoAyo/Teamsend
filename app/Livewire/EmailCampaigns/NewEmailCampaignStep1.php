<?php

namespace App\Livewire\EmailCampaigns;

use Livewire\Component;

class NewEmailCampaignStep1 extends Component
{
    public $formData = [];

    public $name;
    public $description;
    public $subject;
    public $set_from;
    public $reply_to;
    public $active;

    protected $rules = [
        'name' => "required|max:255",
        'subject' => "required|max:255",
        'set_from' => "required|email|max:255",
        'reply_to' => "required|email|max:255",
    ];

    public function mount($formData)
    {
        $this->formData = $formData;
        $this->name = $formData['name'];
        $this->description = $formData['description'];
        $this->subject = $formData['subject'];
        $this->set_from = $formData['set_from'];
        $this->reply_to = $formData['reply_to'];
        $this->active = $formData['active'];
    }

    public function nextStep()
    {
        $validatedData = $this->validate();

        $this->formData = [
            "name" => $validatedData['name'],
            "description" => $this->description,
            "subject" => $validatedData['subject'],
            "set_from" => $validatedData['set_from'],
            "reply_to" => $validatedData['reply_to'],
            "active" => $this->active
        ];

        // next step
        $this->dispatch("navigate", step: 2);

        $this->dispatch("updateFormData", step: "step1", data: $this->formData);
    }

    public function render()
    {
        return view('livewire.email-campaigns.new-email-campaign-step1');
    }
}
