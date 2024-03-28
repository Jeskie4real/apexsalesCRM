<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Customer extends Model
{
     protected $fillable = [
         'contact_id',
     ];

     public function contact() :BelongsTo
     {
         return $this->belongsTo(Contact::class);
     }
}