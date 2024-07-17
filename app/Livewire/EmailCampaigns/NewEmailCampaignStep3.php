<?php

namespace App\Livewire\EmailCampaigns;

use App\Models\Lists;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class NewEmailCampaignStep3 extends Component
{
    public $formData = []; 
    public $org_id;
    public $user_id;
    public $org_name;
    public $group;

    protected $rules = [
        'group' => "required",
    ];

    public function mount($formData, $orgId, $orgName){
        $this->org_id = $orgId;
        $this->org_name = $orgName;
        $this->formData = $formData;
        $this->user_id = Auth::user()->id;
    }

    public function getTotalGroupsProperty(){
        $orgId = $this->org_id;

        return Lists::whereHas('userOrganisation', function ($query) use ($orgId) {
            $query->where('org_id', $orgId);
        })->count();
    }

    public function previousStep()
    {
        // previous step
        $this->dispatch("navigate", step: 2);
    }

    public function createCampaign(){
        $validatedData = $this->validate();

        $this->formData = [
            "selectedEmailGroup" => $validatedData['group']
        ];

        $this->dispatch("updateFormData", step: "step3", data: $this->formData);

        $this->dispatch('submitForm');
    }

    public function render()
    {
        $orgId = $this->org_id;

        $groups = Lists::whereHas('userOrganisation', function ($query) use ($orgId) {
            $query->where('org_id', $orgId);
        })
        ->with('userOrganisation.user')
        ->orderBy('created_at', 'desc')
        ->get();

        return view('livewire.email-campaigns.new-email-campaign-step3', [
            'groups' => $groups,
            'totalGroups' => $this->totalGroups
        ]);
    }
}
