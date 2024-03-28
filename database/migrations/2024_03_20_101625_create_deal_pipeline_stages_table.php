<?php

use App\Models\PipelineStage;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('deal_pipeline_stages', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Deal::class)->constrained();
            $table->foreignIdFor(PipelineStage::class)->nullable()->constrained();
            $table->foreignIdFor(User::class,'employee_id')->nullable(); //assigned to related tasks
            $table->foreignIdFor(User::class,)->nullable(); //creator
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deal_pipeline_stages');
    }
};
