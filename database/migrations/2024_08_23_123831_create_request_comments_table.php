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
        Schema::create('request_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('request_id')->constrained();
            $table->enum('type',[
                \App\Enums\RequestCommentType::TEXT->value,
                \App\Enums\RequestCommentType::URL->value,
                \App\Enums\RequestCommentType::FILE->value,
                \App\Enums\RequestCommentType::IMG->value,
            ]);
            $table->text('message');
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_comments');
    }
};
