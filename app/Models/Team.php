<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model
{
    use HasFactory;
    protected $fillable =['name','team_manager_id'];

    public function teamManager(): BelongsTo
    {
        return $this->belongsTo(TeamManager::class);
    }

    public function teamMembers(): HasMany
    {
        return $this->hasMany(SalesRepresentative::class);
    }
}
