<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Quote extends Model
{
    use HasFactory;
    protected $fillable = ['deal_id','account_id','organization_id','quote_date','expiry_date', 'status',
        'contact_id','total', 'status','discount'];

    public function deal(): BelongsTo
    {
        return $this->belongsTo(Deal::class);
    }
    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    public function quoteItems(): HasMany
    {
        return $this->hasMany(QuoteItem::class);
    }

    protected function total(): Attribute
    {
        return Attribute::make(
            get: function () {
                $total = 0;

                foreach ($this->quoteItems as $quoteItem) {
                    $total += $quoteItem->price * $quoteItem->quantity;
                }

                return $total ;
            }
        );
    }

    protected function subtotal(): Attribute
    {
        return Attribute::make(
            get: function () {
                $subtotal = 0;

                foreach ($this->quoteItems as $quoteItem) {
                    $subtotal += $quoteItem->price * $quoteItem->quantity;
                }

                return $subtotal;
            }
        );
    }
}
