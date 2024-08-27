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
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->id();
            $table->string('details');
            $table->float('quantity');
            $table->float('cost');
            $table->float('amount');
            $table->foreignId('discount_id')->nullable()->index()->constrained('discounts');
            $table->foreignId('measurement_id')->constrained('measurements');
            $table->foreignId('invoice_id')->constrained('invoices');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_items');
    }
};
