<?php

use App\Enums\RequestPaymentStatus;
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
                    RequestPaymentStatus::PENDING->name,
                    RequestPaymentStatus::TO_RETURN->name,
                    RequestPaymentStatus::HOLD->name,
                    RequestPaymentStatus::TO_PROCESS->name,
                    RequestPaymentStatus::PROCESSING->name,
                    RequestPaymentStatus::FOR_FUNDING->name,
                    RequestPaymentStatus::RELEASED->name,
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
