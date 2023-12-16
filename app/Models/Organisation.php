<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Organisation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'website',
        'phone',
        'owner_role',
        'targeted_emails',
        'employee_count',
    ];

    // Define relationships if any
    public function users():BelongsToMany {
        return $this->belongsToMany(User::class, 'user_organisations', 'org_id', 'user_id')
                    ->withPivot('is_admin');
    }

    public function userOrganisations()
    {
        return $this->hasMany(UserOrganisation::class, 'org_id');
    }
}
