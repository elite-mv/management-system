<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('request_deliveries', function (Blueprint $table) {
            $table->id();
            $table->boolean('completed')->nullable();
            $table->boolean('supplier_verified')->nullable();
            $table->foreignId('request_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_deliveries');
    }
};
