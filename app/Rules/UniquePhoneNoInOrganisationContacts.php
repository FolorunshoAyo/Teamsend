<?php

namespace App\Rules;

use Closure;
use App\Models\Contact;
use Illuminate\Contracts\Validation\ValidationRule;

class UniquePhoneNoInOrganisationContacts implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */

     private $orgId;
     private $country_code;
     private $contactId;
     
     public function __construct($orgId, $country_code, $contact_id = "")
    {
        $this->orgId = $orgId;
        $this->country_code = $country_code;
        $this->contactId = $contact_id;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if($this->contactId !== ""){
            if(Contact::whereHas('userOrganisation', function ($query) {
                $query->where('org_id', $this->orgId);
            })
            ->where('phone', $value)
            ->where('country_code', $this->country_code)
            ->where('id', '!=', $this->contactId)
            ->exists()){
                $fail('The :attribute exists in this organisation');
            }
        }else{
            if(Contact::whereHas('userOrganisation', function ($query) {
                $query->where('org_id', $this->orgId);
            })->where('phone', $value)->where('country_code', $this->country_code)->exists()){
                $fail('The :attribute exists in this organisation');
            }
        }
    }
}
