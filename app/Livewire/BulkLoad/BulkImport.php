<?php

namespace App\Livewire\BulkLoad;

use App\Models\Lists;
use App\Models\Contact;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\UserOrganisation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BulkImport extends Component
{
    use WithFileUploads;

    public $csvFile;
    public $contactsUploaded = 0;
    public $duplicateContacts = 0;
    public $createGroup = false;
    public $groupName;
    public $groupDesc;
    public $groupActive;
    public $org_name;
    public $isGroupCreated;
    // public $listType;
    public $orgId;

    protected $columnDataTypes = [
        'first_name' => 'string',
        'last_name' => 'string',
        'email' => 'email',
        'country_code' => 'string',
        'phone' => 'string',
    ];

    protected $columnMaxLengths = [
        'first_name' => 255,
        'last_name' => 255,
        'email' => 255,
        'country_code' => 10,
        'phone' => 15,
    ];

    protected $validCountryCodes =  [
        "93", "355", "213", "1-684", "376", "244", "1-264", "672", "1-268", "54",
        "374", "297", "61", "43", "994", "1-242", "973", "880", "1-246", "375",
        "32", "501", "229", "1-441", "975", "591", "387", "267", "55", "246", "1-284",
        "673", "359", "226", "257", "855", "237", "1", "238", "1-345", "236", "235",
        "56", "86", "61", "61", "57", "269", "682", "506", "385", "53", "599", "357",
        "420", "243", "45", "253", "1-767", "1-809, 1-829, 1-849", "670", "593", "20",
        "503", "240", "291", "372", "251", "500", "298", "679", "358", "33", "689",
        "241", "220", "995", "49", "233", "350", "30", "299", "1-473", "1-671", "502",
        "44-1481", "224", "245", "592", "509", "504", "852", "36", "354", "91", "62",
        "98", "964", "353", "44-1624", "972", "39", "225", "1-876", "81", "44-1534",
        "962", "7", "254", "686", "383", "965", "996", "856", "371", "961", "266",
        "231", "218", "423", "370", "352", "853", "389", "261", "265", "60", "960",
        "223", "356", "692", "222", "230", "262", "52", "691", "373", "377", "976",
        "382", "1-664", "212", "258", "95", "264", "674", "977", "31", "599", "687",
        "64", "505", "227", "234", "683", "850", "1-670", "47", "968", "92", "680",
        "970", "507", "675", "595", "51", "63", "64", "48", "351", "1-787, 1-939",
        "974", "242", "262", "40", "7", "250", "590", "290", "1-869", "1-758", "590",
        "508", "1-784", "685", "378", "239", "966", "221", "381", "248", "232", "65",
        "1-721", "421", "386", "677", "252", "27", "82", "211", "34", "94", "249",
        "597", "47", "268", "46", "41", "963", "886", "992", "255", "66", "228", "690",
        "676", "1-868", "216", "90", "993", "1-649", "688", "1-340", "256", "380",
        "971", "44", "1", "598", "998", "678", "379", "58", "84", "681", "212", "967",
        "260", "263"
    ];

    public function mount($orgId, $orgName){
        $this->orgId = $orgId;
        $this->org_name = $orgName;
    }

    // public function updatedCsvFile()
    // {
    //     $this->validateOnly('csvFile');
    // }

    public function import()
    {
        $this->isGroupCreated = false;

        if(!$this->createGroup){
            $this->validate([ 
                'csvFile' => 'required|file|mimes:csv|max:20480',
            ]);
        }else{
            $this->validate([ 
                'csvFile' => 'required|file|mimes:csv|max:20480',
                'groupName' => "required|max:255"
            ]);
        }

        // For storing all group contacts in case of group creation
        $groupContactsArr = [];

        $user = Auth::user();

        $user_org_id = UserOrganisation::where('user_id', $user->id)
        ->where('org_id', $this->orgId)
        ->first();

        $path = $this->csvFile->store('temp');  // Store the file temporarily

        $file = Storage::get($path);
        $rows = explode("\n", $file);

        // Get the header row to map columns
        $headers = str_getcsv($rows[0]);

        if ($headers !== array_keys($this->columnDataTypes)) {
            // $this->addError('error', "Invalid column headers or order.");
            session()->flash('error', "Invalid column headers or order.");
            return;
        }

        $allUploadedContactData = [];

        $this->resetCounts();
        foreach ($rows as $index => $row) {
            if ($index === 0) continue; // Skip header row

            if (trim($row) === '') continue;

            $data = str_getcsv($row);
            $contactData = [];

            foreach ($headers as $headerIndex => $header) {
                $expectedType = $this->columnDataTypes[$header];
                $maxLength = $this->columnMaxLengths[$header];

                $value = trim((string) ($data[$headerIndex] ?? ''));;

                // Tracking Row
                $row = $index + 1;

                // Check for empty cells
                if ($value === '') {
                    session()->flash('error', "Empty cell found in row $row for column $header.");
                    return;
                }

                switch ($expectedType) {
                    case 'string':
                        // Validate country_code
                        if($header === "country_code"){
                            $countryCode = $value;
                            if (!in_array($countryCode, $this->validCountryCodes)) {
                                session()->flash('error', "Invalid country code found in row $row.");
                                return;
                            }
                            $contactData[$header] = "+$value";
                        }else{
                            $contactData[$header] = $value;
                        }
                        break;
                    case 'email':
                        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                            session()->flash('error', "Invalid email format in row $row.");
                            return;
                        }
                        $contactData[$header] = $value;
                        break;
                }

                if (strlen($value) > $maxLength) {
                    session()->flash('error', "Data in $header exceeds maximum length in row $row.");
                    return;
                }
            }

            array_push($allUploadedContactData, $contactData);
        }

        //Handle uploaded contacts
        foreach($allUploadedContactData as $uploadedContact){

            $contactData = $uploadedContact;

            // dd($contactData);
            // Check if the contact already exists
            $existingContact = Contact::whereHas('userOrganisation', function ($query) {
                $query->where('org_id', $this->orgId);
            }) 
            ->where('email', $contactData['email'])->first();

            if (!$existingContact) {
                $createdContact = Contact::create([
                    'user_org_id' => $user_org_id->id,
                    'first_name' => $contactData['first_name'],
                    'last_name' => $contactData['last_name'],
                    'email' => $contactData['email'],
                    'phone' => $contactData['phone'],
                    'country_code' => $contactData['country_code'],
                ]);

                $contact_id = $createdContact->id;

                array_push($groupContactsArr, $contact_id);

                $this->contactsUploaded++;
            } else {
                $existingContact = Contact::find($existingContact->id);

                $existingContact->first_name = $contactData['first_name'];
                $existingContact->last_name = $contactData['last_name'];
                $existingContact->email = $contactData['email'];
                $existingContact->phone = $contactData['phone'];
                $existingContact->country_code = $contactData['country_code'];

                $existingContact->save();
                
                array_push($groupContactsArr, $existingContact->id);
                $this->duplicateContacts++;
            }

        }

        if($this->createGroup){
            $listCreated = Lists::create([
                "user_org_id" => $user_org_id->id,
                "list_name" => $this->groupName,
                "list_description" => $this->groupDesc,
                "active" => $this->groupActive? "1" : "0"
            ]);
    
            $listCreatedId = $listCreated->id;
    
            $list = Lists::find($listCreatedId);
    
            // Attach contacts to new lists
            $list->contacts()->attach($groupContactsArr);

            $this->isGroupCreated = true;
        }

        // Delete the temporary file
        Storage::delete($path);
    }

    public function resetCounts(){
        $this->duplicateContacts = 0;
        $this->contactsUploaded = 0;
    }

    public function toggleCreateGroup(){
        $this->createGroup = !$this->createGroup;
    }
    
    public function render()
    {
        return view('livewire.bulk-load.bulk-import');
    }
}
