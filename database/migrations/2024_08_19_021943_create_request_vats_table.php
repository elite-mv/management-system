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
        Schema::create('request_vats', function (Blueprint $table) {
            $table->id();
            $table->string('purchase_order')->nullable();
            $table->string('invoice')->nullable();
            $table->string('bill')->nullable();
            $table->string('official_receipt')->nullable();
            $table->foreignId('request_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_vats');
    }
};
