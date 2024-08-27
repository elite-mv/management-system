<?php

use App\Enums\Income\InvoicePaymentType;
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
        Schema::create('invoice_payments', function (Blueprint $table) {
            $table->id();
            $table->float('amount');
            $table->string('reference');
            $table->enum('type', [
                    InvoicePaymentType::CASH->name,
                    InvoicePaymentType::E_WALLET->name,
                    InvoicePaymentType::CHECK->name,
                ]);
            $table->foreignId('invoice_id')->constrained('invoices');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_payments');
    }
};
