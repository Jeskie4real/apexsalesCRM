<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = ['invoice_number','organization_id',
        'contact_id','quote_id','invoice_date','due_date','total',
        ];
   public function organization(): BelongsTo
   {
      return $this->belongsTo(Organization::class);
   }
    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }
    public function invoiceItems(): HasMany
    {
        return $this->hasMany(InvoiceItem::class);
    }
    public function quote(): BelongsTo
    {
        return $this->belongsTo(Quote::class);
    }
}
