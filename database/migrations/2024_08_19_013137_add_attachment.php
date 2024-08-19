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
        Schema::table('requests', function (Blueprint $table) {
            $table->enum('attachment', [
                \App\Enums\AccountingAttachment::DEFAULT->name,
                \App\Enums\AccountingAttachment::WITH->name,
                \App\Enums\AccountingAttachment::WITHOUT->name,
            ]);

            $table->enum('type', [
                \App\Enums\AccountingType::DEFAULT->name,
                \App\Enums\AccountingType::OPEX->name,
                \App\Enums\AccountingType::NON_OPEX->name,
            ]);


            $table->enum('receipt', [
                \App\Enums\AccountingReceipt::DEFAULT->name,
                \App\Enums\AccountingReceipt::NONE->name,
                \App\Enums\AccountingReceipt::DELIVERY_RECEIPT->name,
                \App\Enums\AccountingReceipt::OFFICIAL_RECEIPT_VAT->name,
            ]);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('request', function (Blueprint $table) {
            $table->removeColumn('attachment');
            $table->removeColumn('type');
            $table->removeColumn('receipt');
        });
    }
};
