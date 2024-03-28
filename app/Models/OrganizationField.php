<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationField extends Model
{
    protected $fillable = [
        'name',
        'organization_id'
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}
