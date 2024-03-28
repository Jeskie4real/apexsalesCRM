<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReportFilter extends Model
{
    use HasFactory;

    protected $fillable =[
        'name','report_id', 'filter'
    ];

    public function report(): BelongsTo
    {
        return $this->belongsTo(Report::class);
    }
}
