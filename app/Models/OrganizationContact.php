<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationContact extends Model
{
    use HasFactory;
    protected $fillable = [
        'contact_id',
        'organization_id'
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}
