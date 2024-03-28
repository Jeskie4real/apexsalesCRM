<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DealQoute extends Model
{
    protected $fillable =[
        'deal_id',
        'quote_id'
    ];

    public function deal()
    {
       return $this->belongsTo(Deal::class);
    }

    public function quote()
    {
        return $this->belongsTo(Quote::class);
    }
}
