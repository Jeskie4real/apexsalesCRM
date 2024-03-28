<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Deal extends Model
{
    use HasFactory;
    protected $fillable = [
        'contact_id',
        'lead_source_id',
        'pipeline_stage_id',
        'employee_id',
    ];

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }
    public function dealQuotes(): HasMany
    {
        return $this->hasMany(DealQoute::class);
    }
    public function leadSource(): BelongsTo
    {
        return $this->belongsTo(LeadSource::class);
    }



    public function pipelineStage(): BelongsTo
    {
        return $this->belongsTo(PipelineStage::class);
    }

    public function pipelineStageLogs(): HasMany
    {
        return $this->hasMany(DealPipelineStage::class);
    }

    public static function booted(): void
    {
        self::created(function (Deal $deal) {
            $deal->pipelineStageLogs()->create([
                'pipeline_stage_id' => $deal->pipeline_stage_id,
                'employee_id' => $deal->employee_id,
                'user_id' => auth()->check() ? auth()->id() : null
            ]);
        });

        self::updated(function (Deal $deal) {
            $lastLog = $deal->pipelineStageLogs()->whereNotNull('employee_id')->latest()->first();

            // Here, we will check if the employee has changed, and if so - add a new log
            if ($lastLog && $deal->employee_id !== $lastLog?->employee_id) {
                $deal->pipelineStageLogs()->create([
                    'employee_id' => $deal->employee_id,
                    'notes' => is_null($deal->employee_id) ? 'Employee removed' : '',
                    'user_id' => auth()->id()
                ]);
            }
        });
    }


    public function customFields(): HasMany
    {
        return $this->hasMany(DealCustomField::class);
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function completedTasks(): HasMany
    {
        return $this->hasMany(Task::class)->where('completed', true);
    }

    public function incompleteTasks(): HasMany
    {
        return $this->hasMany(Task::class)->where('completed', false);
    }
}
