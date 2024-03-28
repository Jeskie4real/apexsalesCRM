<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DealCustomField extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function deal(): BelongsTo
    {
        return $this->belongsTo(Deal::class);
    }

    public function customField(): BelongsTo
    {
        return $this->belongsTo(CustomField::class);
    }
}
