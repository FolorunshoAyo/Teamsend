<?php

namespace App\Livewire\BulkLoad;

use App\Models\Contact;
use Livewire\Component;

class BulkExport extends Component
{
    public $orgId;
    public $orgName;

    public function mount($orgId, $orgName){
        $this->orgId = $orgId;
        $this->orgName = $orgName;
    }

    public function render()
    {
        return view('livewire.bulk-load.bulk-export');
    }

    public function exportContacts()
    {
        $orgId = $this->orgId;

        $contacts = Contact::whereHas('userOrganisation', function ($query) use ($orgId) {
            $query->where('org_id', $orgId);
        })->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=' . $this->orgName . '-contacts.csv',
        ];

        $callback = function () use ($contacts) {
            $file = fopen('php://output', 'w');
            
            // Add CSV header
            fputcsv($file, ['first_name', 'last_name', 'email', 'country_code', 'phone']);

            foreach ($contacts as $contact) {
                $country_code = str_replace('+', '', $contact->country_code);
                fputcsv($file, [$contact->first_name, $contact->last_name, $contact->email, $country_code, $contact->phone]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
