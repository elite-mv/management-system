<?php

use App\Enums\RequestApprovalStatus;
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
        Schema::create('book_keeper_approvals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('request_id')->constrained();
            $table->enum('status', [
                RequestApprovalStatus::PENDING->name,
                RequestApprovalStatus::APPROVED->name,
                RequestApprovalStatus::DISAPPROVED->name
            ]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_keeper_approvals');
    }
};
