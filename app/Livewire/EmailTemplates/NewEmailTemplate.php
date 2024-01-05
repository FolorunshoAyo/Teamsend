<?php

namespace App\Livewire\EmailTemplates;

use App\Models\Template;
use Livewire\Component;
use Illuminate\Validation\Rule;
use App\Models\UserOrganisation;
use Illuminate\Support\Facades\Auth;

class NewEmailTemplate extends Component
{
    public $template_title;
    public $selected_design_template;
    public $org_id;
    public $org_name;

    public function mount($orgId, $orgName){
        $this->org_id = $orgId;
        $this->org_name = $orgName;
    }

    public function createTemplate(){
        $this->validate([
            'template_title' => 'required|max:255',
            'selected_design_template' => [
                'required',
                Rule::in(
                    [
                        'blank',
                        'pricing-table',
                        'listing-and-tables',
                        '1-2-1-column-layout',
                        '1-2-column-layout',
                        '1-3-1-column-layout',
                        '1-3-2-column-layout',
                        '1-3-column-layout',
                        'one-column-layout',
                        '2-1-2-column-layout',
                        '2-1-column-layout',
                        'two-columns-layout',
                        '3-1-3-column-layout',
                        'three-columns-layout'
                    ]
                )
            ],
        ]);

        $user = Auth::user();

        $user_org_id = UserOrganisation::where('user_id', $user->id)
        ->where('org_id', $this->org_id)
        ->first();

        $newTemplate = Template::create([
            "user_org_id" => $user_org_id->id,
            "template_name" => $this->template_title,
            "design_template" => $this->selected_design_template,
        ]);

        return redirect()->route('org-admin.edit-email-template', [
            'organisation' => $this->org_name,
            'id' => $newTemplate->id 
        ]);

    }

    public function render()
    {
        return view('livewire.email-templates.new-email-template');
    }
}
