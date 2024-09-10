<?php

use App\Enums\RequestStatus;
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
        Schema::table('requests', function (Blueprint $table) {
            $table->enum('status',[
                RequestStatus::PENDING->value,
                RequestStatus::TO_RETURN->value,
                RequestStatus::HOLD->value,
                RequestStatus::TO_PROCESS->value,
                RequestStatus::PROCESSING->value,
                RequestStatus::FOR_FUNDING->value,
                RequestStatus::RELEASED->value,
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('requests', function (Blueprint $table) {
            $table->removeColumn('status');
        });
    }
};
