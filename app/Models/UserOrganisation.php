<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserOrganisation extends Model
{
    use HasFactory;

    protected $table = 'user_organisations';

    protected $fillable = [
        'user_id',
        'org_id',
        'is_admin',
        // Add other fillable fields as needed
    ];

    // Define relationships
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function organisation() {
        return $this->belongsTo(Organisation::class);
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class, 'user_org_id');
    }

    public function lists()
    {
        return $this->hasMany(Lists::class, 'user_org_id');
    }
}
