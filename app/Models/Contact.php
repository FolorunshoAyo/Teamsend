<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'country_code',
        'is_subscribed',
        'is_blocked',
        'is_favourite',
        'is_trashed',
        'user_org_id',
    ];

    public function userOrganisation()
    {
        return $this->belongsTo(UserOrganisation::class, 'user_org_id');
    }

    public function userOrganisations()
    {
        return $this->hasMany(UserOrganisation::class, 'user_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_org_id', 'org_id');
    }

    public function lists()
    {
        return $this->belongsToMany(Lists::class, 'lists_contacts', 'contact_id', 'list_id');
    }
}
