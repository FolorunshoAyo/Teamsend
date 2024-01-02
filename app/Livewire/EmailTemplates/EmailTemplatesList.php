<?php

namespace App\Livewire\EmailTemplates;

use App\Models\Template;
use Livewire\Component;
use Livewire\WithPagination;

class EmailTemplatesList extends Component
{
    use WithPagination;
    public $orgId;

    public function mount($orgId){
        $this->orgId = $orgId;
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

    public function render()
    {
        return view(
            'livewire.email-templates.email-templates-list', [
            'templates' => $this->emailTemplates
        ]);
    }
}
