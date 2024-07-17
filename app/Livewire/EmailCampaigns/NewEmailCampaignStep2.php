<?php

namespace App\Livewire\EmailCampaigns;

use Livewire\Component;
use App\Models\Template;

class NewEmailCampaignStep2 extends Component
{    
    public $formData = [];
    public $orgId;
    public $template;

    protected $rules = [
        'template' => "required",
    ];

    public function mount($formData, $orgId)
    {
        $this->orgId = $orgId;
        $this->formData = $formData;
    }

    public function nextStep()
    {
        $validatedData = $this->validate();

        $this->formData = [
            "selectedEmailTemplate" => $validatedData['template'],
        ];

        // next step
        $this->dispatch("navigate", step: 3);

        $this->dispatch("updateFormData", step: "step2", data: $this->formData);
    }

    public function prevStep()
    {
        // prev step
        $this->dispatch("navigate", step: 1);
    }

    public function getTotalTemplatesProperty(){
        $orgId = $this->orgId;

        return Template::whereHas('userOrganisation', function ($query) use ($orgId) {
            $query->where('org_id', $orgId);
        })->count();
    }
    
    public function render()
    {
        $orgId = $this->orgId;

        $emailTemplates = Template::whereHas('userOrganisation', function ($query) use ($orgId) {
            $query->where('org_id', $orgId);
        })
        ->with('userOrganisation.user')
        ->orderBy('created_at', 'desc')
        ->get();

        return view('livewire.email-campaigns.new-email-campaign-step2', [
            'templates' => $emailTemplates,
            'totalTemplates' => $this->totalTemplates
        ]);
    }
}
