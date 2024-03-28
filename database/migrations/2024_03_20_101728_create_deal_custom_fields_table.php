<?php

use App\Models\CustomField;
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
        Schema::create('deal_custom_fields', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Deal::class)->constrained();
            $table->foreignIdFor(CustomField::class)->constrained();
            $table->string('value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deal_custom_fields');
    }
};
