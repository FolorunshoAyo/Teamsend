<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Organisation;
use Illuminate\Validation\Rule;
use App\Models\UserOrganisation;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;

class AccountSetupForm extends Component
{
    #[Validate]
    public $first_name;
    #[Validate]
    public $last_name;
    #[Validate]
    public $company_name;
    #[Validate]
    public $company_website;
    #[Validate]
    public $phone_number;
    #[Validate]
    public $owner_roles;
    #[Validate]
    public $targeted_emails;
    #[Validate]
    public $employee_count;
    public $loading = false;

    // public function messages()
    // {
    //     return [
    //         'first_name.required' => 'The first name field is required.',
    //         'first_name.max' => 'The first name must be at most :max characters.',
    //         'last_name.required' => 'The last name field is required.',
    //         'last_name.max' => 'The password must be at most :max characters.',
    //         'company_name.required' => 'The last name field is required.',
    //         'last_name.max' => 'The password must be at most :max characters.',
    //         'last_name.required' => 'The last name field is required.',
    //         'last_name.max' => 'The password must be at most :max characters.',
    //         'email.email' => 'Please enter a valid email address.',
    //         'password.required' => 'The password is required.',
    //         'passwor d.min' => 'The password must be at least :min characters.',
    //         'password.regex' => 'The password must contain at least one lowercase letter, one uppercase letter, one digit, and one special character.',
    //     ];
    // }

    public function rules(){
        return [
            'first_name' => 'required|max:255|regex:/^[a-zA-Z\d\s]*$/',
            'last_name' => 'required|max:255',
            'company_name' => [
                'required',
                'max:255',
                Rule::unique("organisations", "name")
            ],
            'company_website' => [
                'required',
                'url',
                'max:255',
                Rule::unique("organisations", "website")
            ],
            'phone_number' => [
                'required',
                'max:20',
                Rule::unique("organisations", "phone")
            ],
            'owner_roles' => [
                'required',
                Rule::in(['CEO', 'Marketer', 'Developer', 'Other'])
            ],
            'targeted_emails' => [
                'required',
                Rule::in(['0-5k', '5k-10k', '10k-20k', '20k-30k'])
            ],
            'employee_count' => [
                'required',
                Rule::in(['1-50', '50-100', '100-500', '500-1000'])
            ],
        ];
    }

    public function submitAccountSetupForm()
    {
        $this->loading = true;

        // Validate the submitted data
        $validatedData = $this->validate();

        // Create new organisation
        $organisation = Organisation::create([
            'name' => $validatedData['company_name'],
            'website' => $validatedData['company_website'],
            'phone' => $validatedData['phone_number'],
            'owner_role' => $validatedData['owner_roles'],
            'targeted_emails' => $validatedData['targeted_emails'],
            'employee_count' => $validatedData['employee_count'],
        ]);

        // retrieve created organisation details 
        $organisation_name = $organisation->name;
        $organisation_id = $organisation->id;

        // GET CURRENT USER IN SESSION
        $user = Auth::user();

        // Create User_Organisation Records
        UserOrganisation::create([
            'user_id' => $user->id,
            'org_id' => $organisation_id,
            'is_admin' => 1,
        ]);

        // Update users Table
        $user = User::find($user->id);

        $user->first_name = $validatedData['first_name'];
        $user->last_name = $validatedData['last_name'];

        $user->save();

        session()->flash('success', 'Organisation created successfully');

        $url_formatted_org_name = strtolower(join("-", explode(" ", $organisation_name)));
        $url = route('org-admin.dashboard', ['organisation' => $url_formatted_org_name]);
        
        return redirect()->route($url);
    }

    public function render()
    {
        return view('livewire.account-setup-form');
    }
}
