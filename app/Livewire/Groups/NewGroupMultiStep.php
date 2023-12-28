<?php

namespace App\Livewire\Groups;

use App\Models\Lists;
use Livewire\Component;
use App\Models\UserOrganisation;
use Illuminate\Support\Facades\Auth;

class NewGroupMultiStep extends Component
{
    public $currentStep = 1;
    public $formData = [
        "step1" => [
            "name" => "",
            "description" => "",
            "active" => false
        ],
        "step2" => [
            "selectedContacts" => []
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

        $listCreated = Lists::create([
            "user_org_id" => $user_org_id->id,
            "list_name" => $formDataToBeSubmitted['step1']['name'],
            "list_description" => $formDataToBeSubmitted['step1']['description'],
            "active" => $formDataToBeSubmitted['step1']['active']? "" : "0"
        ]);

        $listCreatedId = $listCreated->id;

        $list = Lists::find($listCreatedId);

        // Attach contacts to new lists
        $list->contacts()->attach($formDataToBeSubmitted['step2']['selectedContacts']); 

        session()->flash('success', 'Group Created successfully!');

        return redirect()->route('org-admin.groups', ['organisation' => $this->orgName]);
    }

    public function render()
    {
        return view('livewire.groups.new-group-multi-step');
    }
}
