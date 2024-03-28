<?php

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
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Deal::class)->constrained();
            $table->foreignIdFor(\App\Models\Organization::class)->constrained();
            $table->foreignIdFor(\App\Models\Contact::class)->constrained();
            $table->date('quote_date');
            $table->date('expiry_date');
            $table->double('total');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotes');
    }
};
