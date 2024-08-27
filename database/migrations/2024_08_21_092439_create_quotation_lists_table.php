<?php

use App\Enums\Income\QuotationStatus;
use Carbon\Carbon;
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

        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->string('subject');
            $table->string('note');
            $table->float('shipping_charges')->default(0);
            $table->enum('status',[
                QuotationStatus::PENDING->name,
                QuotationStatus::ACCEPTED->name,
                QuotationStatus::EXPIRED->name,
            ]);
            $table->date('expiry_date')->default(Carbon::now()->addDays(15)->format('Y-m-d'));
            $table->foreignId('customer_id')->index()->constrained('customers');
            $table->foreignId('currency_id')->index()->constrained('currencies');
            $table->foreignId('sales_officer')->index()->constrained('users');
            $table->foreignId('company_id')->index()->constrained('companies');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotations');
    }
};
