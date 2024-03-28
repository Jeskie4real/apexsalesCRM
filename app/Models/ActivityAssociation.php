<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActivityAssociation extends Model
{
    use HasFactory;
    protected $fillable =[
        'activity_id','association_type','activity_id'
    ];
    public function activity(): BelongsTo
    {
        return $this->belongsTo(Activity::class);
    }
}
