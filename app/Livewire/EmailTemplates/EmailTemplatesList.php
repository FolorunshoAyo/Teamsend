<?php

namespace App\Livewire\EmailTemplates;

use App\Models\Template;
use Livewire\Component;
use Livewire\WithPagination;

class EmailTemplatesList extends Component
{
    use WithPagination;
    public $orgId;
    public $org_name;
    public $confirmingTemplateId = null;

    public function mount($orgId, $orgName){
        $this->orgId = $orgId;
        $this->org_name = $orgName;
    }

    public function getEmailTemplatesProperty(){
        $orgId = $this->orgId;
        
        return Template::whereHas('userOrganisation', function ($query) use ($orgId) {
            $query->where('org_id', $orgId);
        })
        ->with('userOrganisation.user')
        ->orderBy('created_at', 'desc')
        ->paginate(6);
    }

    public function duplicateTemplate($template_id){
        $orgId = $this->orgId;

        $template = Template::whereHas('userOrganisation', function ($query) use ($orgId) {
            $query->where('org_id', $orgId);
        })
        ->where("id", $template_id);

        if ($template && $template->exists()) {
            $duplicateTemplate = $template->first()->replicate();
            $duplicateTemplate->save();
            $this->dispatch("success", message: "Template duplicated successfully");
        }else{
            $this->dispatch("error", message: "Unable to duplicate template");
        }
    }

    public function deleteTemplate()
    {
        $orgId = $this->orgId;

        $template = Template::whereHas('userOrganisation', function ($query) use ($orgId) {
            $query->where('org_id', $orgId);
        })
        ->where("id", $this->confirmingTemplateId);

        if ($template && $template->exists()) {
            $template->delete();
            $this->confirmingTemplateId = null;
            $this->dispatch("success", message: "Template deleted successfully");
        }else{
            $this->dispatch("error", message: "Unable to delete template");
        }
    }

    public function confirmTemplateDelete($template_id)
    {
        $this->confirmingTemplateId = $template_id;
    }

    public function getTotalTemplatesProperty(){
        $orgId = $this->orgId;

        return Template::whereHas('userOrganisation', function ($query) use ($orgId) {
            $query->where('org_id', $orgId);
        })->count();
    }

    public function render()
    {
        return view(
            'livewire.email-templates.email-templates-list', [
            'templates' => $this->emailTemplates,
            'totalTemplates' => $this->totalTemplates
        ]);
    }
}
