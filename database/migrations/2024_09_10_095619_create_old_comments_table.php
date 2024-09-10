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
//        `id`, `reference`, `username`, `message`, `time`
        Schema::create('old_comments', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->nullable();
            $table->string('username')->nullable();
            $table->text('message')->nullable();
            $table->date('time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('old_comments');
    }
};
