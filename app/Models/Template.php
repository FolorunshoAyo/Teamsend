<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_org_id',
        'template_name',
        'template_file_destination',
        'template_html',
    ];

    /**
     * Get the user organisation that owns the template.
     */
    public function userOrganisation()
    {
        return $this->belongsTo(UserOrganisation::class, 'user_org_id');
    }
    
}
