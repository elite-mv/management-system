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
        Schema::create('old_request_lists', function (Blueprint $table) {
            $table->id();
            $table->text('email')->nullable();
            $table->text('entity')->nullable();
            $table->text('deyt')->nullable();
            $table->text('supplier')->nullable();
            $table->text('paid_to')->nullable();
            $table->text('requested_by')->nullable();
            $table->text('prepared_by')->nullable();
            $table->text('total')->nullable();
            $table->text('reference')->nullable();
            $table->text('check_voucher')->nullable();
            $table->text('bk_status')->nullable();
            $table->text('bk_date')->nullable();
            $table->text('acc_status')->nullable();
            $table->text('acc_date')->nullable();
            $table->text('fin_status')->nullable();
            $table->text('fin_date')->nullable();
            $table->text('aud_status')->nullable();
            $table->text('aud_date')->nullable();
            $table->text('payment_type')->nullable();
            $table->text('terms')->nullable();
            $table->text('check')->nullable();
            $table->text('check2')->nullable();
            $table->text('value')->nullable();
            $table->text('value2')->nullable();
            $table->text('bank_name')->nullable();
            $table->text('account_name')->nullable();
            $table->text('account_number')->nullable();
            $table->text('bank_code')->nullable();
            $table->text('check_number')->nullable();
            $table->text('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('old_request_lists');
    }
};
