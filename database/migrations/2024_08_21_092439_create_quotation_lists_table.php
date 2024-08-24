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
        Schema::create('quotation_lists', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('start_date');
            $table->string('expiry_date');
            $table->string('subject');
            $table->string('unit');
            $table->float('discount');
            $table->float('shipping_charges');
            $table->string('currency');
            $table->string('email');
            $table->float('amount');
            $table->string('message');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotation_lists');
    }
};
