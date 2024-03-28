<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReportField extends Model
{
    use HasFactory;
    protected $fillable =[
        'name','report_id', 'field'
    ];

    public function report(): BelongsTo
    {
        return $this->belongsTo(Report::class);
    }
}
