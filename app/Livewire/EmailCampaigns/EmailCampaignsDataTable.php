<?php

namespace App\Livewire\EmailCampaigns;

use Livewire\Component;
use App\Models\Campaign;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class EmailCampaignsDataTable extends Component
{
    use WithPagination;

    public $deleteModalConfirmationVisible = false;
    public $perPage = 10; // Default items per page
    public $search = '';
    public $org_id; 
    public $org_name; 
    public $user_id;
    
    public function mount($orgId, $orgName){
        $this->org_id = $orgId;
        $this->org_name = $orgName;
        $this->user_id = Auth::user()->id;
    }

    public function render()
    {
        $orgId = $this->org_id;
        $searchTerm = $this->search;
        $campaigns = Campaign::whereHas('userOrganisation', function ($query) use ($orgId) {
            $query->where('org_id', $orgId);
        })
        ->where(function ($query) use ($searchTerm) {
            $query->where('campaign_name', 'like', '%' . $searchTerm . '%')
                ->orWhere('campaign_description', 'like', '%' . $searchTerm . '%');
        })
        ->with('userOrganisation.user')
        ->orderBy('created_at', 'desc')
        ->paginate($this->perPage);

        return view('livewire.email-campaigns.email-campaigns-data-table',[
            'campaigns' => $campaigns
        ]);
    }
}
