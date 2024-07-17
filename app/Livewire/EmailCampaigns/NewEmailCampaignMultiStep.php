<?php

namespace App\Livewire\EmailCampaigns;

use App\Models\Campaign;
use Livewire\Component;
use App\Models\UserOrganisation;
use Illuminate\Support\Facades\Auth;

class NewEmailCampaignMultiStep extends Component
{
    public $currentStep = 1;
    public $formData = [
        "step1" => [
            "name" => "",
            "description" => "",
            "subject" => "",
            "set_from" => "",
            "reply_to" => "",
            "active" => false
        ],
        "step2" => [
            "selectedEmailTemplate" => ""
        ],
        "step3" => [
            "selectedEmailGroup" => ""
        ]
    ];

    public $orgName;
    public $orgId;

    protected $listeners = [
        'navigate'=> 'changeStep',
        'updateFormData' => 'updateFormData',
        'submitForm' => 'submitForm'
    ];

    public function mount($orgId, $orgName){
        $this->orgId = $orgId;
        $this->orgName = $orgName;      
    }

    public function changeStep($step)
    {
        $this->currentStep = $step;
    }

    public function updateFormData($step, $data)
    {
        $this->formData[$step] = $data;
    }

    public function submitForm()
    {
        $formDataToBeSubmitted = $this->formData;

        $user = Auth::user();

        $user_org_id = UserOrganisation::where('user_id', $user->id)
        ->where('org_id', $this->orgId)
        ->first();

        // Create new campaign here
        Campaign::create([
            "user_org_id" => $user_org_id->id,
            "campaign_name" => $formDataToBeSubmitted['step1']['name'],
            "campaign_description" => $formDataToBeSubmitted['step1']['description'],
            "subject" => $formDataToBeSubmitted['step1']['subject'],
            "set_from" => $formDataToBeSubmitted['step1']['set_from'],
            "reply_to" => $formDataToBeSubmitted['step1']['reply_to'],
            "status" => $formDataToBeSubmitted['step1']['active']? "1" : "0",
            "send_status" =>  "0",
            "html_template" => $formDataToBeSubmitted['step2']['selectedEmailTemplate'],
            "list" => $formDataToBeSubmitted['step3']['selectedEmailGroup']
        ]);

        session()->flash('success', 'Campaign Created successfully!');

        return redirect()->route('org-admin.email-campaigns', ['organisation' => $this->orgName]);
    }

    public function render()
    {
        return view('livewire.email-campaigns.new-email-campaign-multi-step');
    }
}
