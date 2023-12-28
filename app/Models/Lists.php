<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lists extends Model
{
    use HasFactory;

    protected $fillable = ['list_name', 'list_description', 'user_org_id'];

    public function userOrganisation()
    {
        return $this->belongsTo(UserOrganisation::class, 'user_org_id');
    }

    public function contacts()
    {
        return $this->belongsToMany(Contact::class, 'list_contacts', 'list_id', 'contact_id')
        ->withTimestamps();
    }
}
