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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number');
            $table->foreignIdFor(\App\Models\Organization::class)->constrained();
            $table->foreignIdFor(\App\Models\Contact::class);
            $table->foreignIdFor(\App\Models\Quote::class);
            $table->date('invoice_date');
            $table->date('due_date');
            $table->double('total');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
