<?php

use App\Enums\Income\InvoiceStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoice_approvals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->constrained('roles');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('invoice_id')->constrained('invoices');
            $table->enum('status', [
                InvoiceStatus::PENDING->name,
                InvoiceStatus::APPROVED->name,
                InvoiceStatus::DISAPPROVED->name,
                InvoiceStatus::HOLD->name,
            ]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_approvals');
    }
};
