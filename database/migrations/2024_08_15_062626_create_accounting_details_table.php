<?php

use App\Enums\AccountingReceipt;
use App\Enums\AccountingType;
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
        Schema::create('accounting_details', function (Blueprint $table) {
            $table->id();
            $table->boolean('with_attachement');
            $table->foreignId('request_id');
            $table->enum('type',[AccountingType::NON_OPEX->name, AccountingType::OPEX->name]);
            $table->enum('receipt',[
                AccountingReceipt::NONE->name, 
                AccountingReceipt::DELIVERY_RECEIPT->name, 
                AccountingReceipt::OFFICAL_RECEIPT_VAT->name
            ]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounting_details');
    }
};
