<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuoteItem extends Model
{
    use HasFactory;
    protected $fillable = ['quote_id', 'item_id','quantity','total'];

    protected function total(): Attribute
    {
        return Attribute::make(
            get: fn($value,$quantity, $discount) => ($value * $quantity) - $discount,
            set: fn($value,$quantity, $discount) => ($value * $quantity) - $discount,
        );
    }

    public function quote(): BelongsTo
    {
        return $this->belongsTo(Quote::class);
    }
    public function item() :BelongsTo
    {
        return $this->belongsTo(Item::class);
    }
}
