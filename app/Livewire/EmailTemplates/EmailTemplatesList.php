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

    // created by <span class="text-green-500">{{ $templates->userOrganisation->user->id !== $user->id ? $templates->userOrganisation->user->first_name . ' ' . $templates->userOrganisation->user->last_name : 'Me'  }}</span>
    public function render()
    {
        // dd($this->emailTemplates);

        return view(
            'livewire.email-templates.email-templates-list', [
            'templates' => $this->emailTemplates
        ]);
    }
}
