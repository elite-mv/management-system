<?php

use App\Enums\Income\InvoicePaymentApproval;
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
        Schema::create('invoice_payment_approvals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->constrained('roles');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('invoice_payment_id')->constrained('invoice_payments');
            $table->enum('status', [
                InvoicePaymentApproval::PENDING->name,
                InvoicePaymentApproval::APPROVED->name,
                InvoicePaymentApproval::DISAPPROVED->name,
                InvoicePaymentApproval::HOLD->name,
            ]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_payment_approvals');
    }
};
