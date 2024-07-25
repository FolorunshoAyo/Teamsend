<?php

namespace App\Livewire\EmailCampaigns;

use Livewire\Component;
use App\Models\Campaign;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class EmailCampaignsDataTable extends Component
{
    use WithPagination;

    public $selectedFilter = 'all';
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

    public function applyFilter($filterValue)
    {
        if($filterValue === "sent"){
            $this->selectedFilter = "sent";
        }elseif($filterValue === "undelivered"){
            $this->selectedFilter = "undelivered";
        }elseif($filterValue === "scheduled"){
            $this->selectedFilter = "scheduled";
        }else{
            $this->selectedFilter = "all";
        }
    }

    public function render()
    {
        $orgId = $this->org_id;
        $searchTerm = $this->search;
        
        $campaigns = "";

        if($this->selectedFilter === 'all'){
            // Query to get all campaigns
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

        }elseif($this->selectedFilter === "sent"){
            // Query to get sent campaigns
            $campaigns = Campaign::whereHas('userOrganisation', function ($query) use ($orgId) {
                $query->where('org_id', $orgId);
            })
            ->where(function ($query) use ($searchTerm) {
                $query->where('campaign_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('campaign_description', 'like', '%' . $searchTerm . '%');
            })
            ->where('send_status', 1)
            ->with('userOrganisation.user')
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);

        }elseif($this->selectedFilter === "undelivered"){
            // Query to get undelivered campaigns
            $campaigns = Campaign::whereHas('userOrganisation', function ($query) use ($orgId) {
                $query->where('org_id', $orgId);
            })
            ->where(function ($query) use ($searchTerm) {
                $query->where('campaign_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('campaign_description', 'like', '%' . $searchTerm . '%');
            })
            ->where('send_status', 0)
            ->with('userOrganisation.user')
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);
        }elseif($this->selectedFilter === "scheduled"){
            // Query to get scheduled campaigns
            $campaigns = Campaign::whereHas('userOrganisation', function ($query) use ($orgId) {
                $query->where('org_id', $orgId);
            })
            ->where(function ($query) use ($searchTerm) {
                $query->where('campaign_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('campaign_description', 'like', '%' . $searchTerm . '%');
            })
            ->where('send_status', 2)
            ->with('userOrganisation.user')
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);
        }

        return view('livewire.email-campaigns.email-campaigns-data-table',[
            'campaigns' => $campaigns
        ]);
    }
}
