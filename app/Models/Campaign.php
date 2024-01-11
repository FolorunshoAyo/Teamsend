<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_org_id',
        'html_template',
        'list',
        'campaign_name',
        'campaign_description',
        'subject',
        'set_from',
        'reply_to',
        'status',
    ];

    public function userOrganisation()
    {
        return $this->belongsTo(UserOrganisation::class, 'user_org_id');
    }

    public function template()
    {
        return $this->belongsTo(Template::class, 'html_template');
    }

    public function campaignList()
    {
        return $this->belongsTo(List::class, 'list');
    }
}
