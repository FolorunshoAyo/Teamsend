<?php

namespace App\Rules;

use Closure;
use App\Models\Contact;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueEmailInOrganisationContacts implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */

     private $orgId;
     private $contactId;

     
     public function __construct($orgId, $contact_id = "")
    {
        $this->orgId = $orgId;
        $this->contactId = $contact_id;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // dd(Contact::whereHas('userOrganisation', function ($query) {
        //     $query->where('org_id', $this->orgId);
        // })->where('email', $value)->exists());

        if($this->contactId !== ""){
            if(Contact::whereHas('userOrganisation', function ($query) {
                $query->where('org_id', $this->orgId);
            })->where('email', $value)
            ->where('id', '!=', $this->contactId)
            ->exists()){
                $fail('The :attribute exists in this organisation');
            }
        }else{
            if(Contact::whereHas('userOrganisation', function ($query) {
                $query->where('org_id', $this->orgId);
            })->where('email', $value)->exists()){
                $fail('The :attribute exists in this organisation');
            }
        }
    }
}
