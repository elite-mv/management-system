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
        Schema::create('old_requests', function (Blueprint $table) {
            $table->id();
            $table->text('email')->nullable();
            $table->text('deyt')->nullable();
            $table->text('qty')->nullable();
            $table->text('uom')->nullable();
            $table->text('job_order')->nullable();
            $table->text('description')->nullable();
            $table->text('unit_cost')->nullable();
            $table->text('total')->nullable();
            $table->text('reference');
            $table->text('status')->nullable();
            $table->text('remarks')->nullable();
            $table->text('accountant')->nullable();
            $table->text('thumbnail')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('old_requests');
    }
};
