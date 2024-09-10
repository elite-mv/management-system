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

        Schema::create('request_approvals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('request_id')->index()->constrained();
            $table->foreignId('role_id')->index()->constrained();
            $table->foreignId('user_id')->index()->nullable()->constrained();
            $table->enum('status', [
                RequestApprovalStatus::PENDING->name,
                RequestApprovalStatus::APPROVED->name,
                RequestApprovalStatus::DISAPPROVED->name,
                RequestApprovalStatus::PRIORITY->name
            ]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_approvals');
    }
};
