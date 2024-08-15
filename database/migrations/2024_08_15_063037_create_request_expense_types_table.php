<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\ExpenseCategory;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('request_expense_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('accounting_detail_id')->constrained();
            $table->enum('type', [
                ExpenseCategory::COST_OF_SALES,
                ExpenseCategory::SUPPLIES_AND_MATERIALS,
                ExpenseCategory::COST_OF_LABOUR,
                ExpenseCategory::SHIPPING_FREIGHT_AND_DELIVERY,
                ExpenseCategory::FREIGHT_AND_DELIVERY,
                ExpenseCategory::OTHER_COSTS_OF_SALES,
                ExpenseCategory::AMORTISATION_EXPENSE,
                ExpenseCategory::BAD_DEBTS,
                ExpenseCategory::BANK_CHARGES,
                ExpenseCategory::COMMISSIONS_AND_FEES,
                ExpenseCategory::OTHER_SELLING_EXPENSES,
                ExpenseCategory::OFFICE_GENERAL_ADMINISTRATIVE_EXPENSES,
                ExpenseCategory::PAYROLL_EXPENSES,
                ExpenseCategory::LEGAL_AND_PROFESSIONAL_FEES,
                ExpenseCategory::ADVERTISING_PROMOTIONAL,
                ExpenseCategory::DUES_AND_SUBSCRIPTIONS,
                ExpenseCategory::RENT_OR_LEASE_OF_BUILDINGS,
                ExpenseCategory::TRAVEL_EXPENSES,
                ExpenseCategory::SHIPPING_AND_DELIVERY_EXPENSE,
                ExpenseCategory::MEALS_AND_ENTERTAINMENT,
                ExpenseCategory::REPAIR_AND_MAINTENANCE,
                ExpenseCategory::EQUIPMENT_RENTAL,
                ExpenseCategory::OTHER_MISCELLANEOUS_SERVICE_COST,
                ExpenseCategory::INCOME_TAX_EXPENSE,
                ExpenseCategory::INSURANCE,
                ExpenseCategory::INTEREST_PAID,
                ExpenseCategory::LOSS_ON_DISCONTINUED_OPERATIONS_NET_OF_TAX,
                ExpenseCategory::MANAGEMENT_COMPENSATION,
                ExpenseCategory::UNAPPLIED_CASH_BILL_PAYMENT_EXPENSE,
                ExpenseCategory::UTILITIES,
                ExpenseCategory::EXCHANGE_GAIN_OR_LOSS,
                ExpenseCategory::OTHER_EXPENSE,
                ExpenseCategory::PENALTIES_AND_SETTLEMENTS,
            ]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_expense_types');
    }
};
