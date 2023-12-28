<?php

namespace App\Livewire\Groups;

use App\Models\Lists;
use Livewire\Component;
use App\Models\UserOrganisation;
use Illuminate\Support\Facades\Auth;

class EditGroupMultiStep extends Component
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
    public $listId;

    protected $listeners = [
        'navigate'=> 'changeStep',
        'updateFormData' => 'updateFormData',
        'submitForm' => 'submitForm'
    ];

    public function mount($orgId, $orgName, $step1FormData, $step2FormData){
        $this->orgId = $orgId;
        $this->orgName = $orgName;
        $this->listId = $step1FormData->id;
        $this->formData['step1']['name'] = $step1FormData->list_name;
        $this->formData['step1']['description'] = $step1FormData->list_description;
        $this->formData['step1']['active'] = $step1FormData->active;
        $this->formData['step2']['selectedContacts'] = $step2FormData;
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

        $list = Lists::find($this->listId);

        $list->list_name = $formDataToBeSubmitted['step1']['name'];
        $list->list_description = $formDataToBeSubmitted['step1']['description'];
        $list->active = $formDataToBeSubmitted['step1']['active']? "1" : "0";

        $list->save();

        // dd($formDataToBeSubmitted['step2']['selectedContacts']);

        // Attach contacts to new lists
        $list->contacts()->sync($formDataToBeSubmitted['step2']['selectedContacts']); 

        session()->flash('success', 'Group Edited successfully!');

        return redirect()->route('org-admin.groups', ['organisation' => $this->orgName]);
    }
    

    public function render()
    {
        return view('livewire.groups.edit-group-multi-step');
    }
}
