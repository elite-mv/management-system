<?php

namespace App\Enums;

enum ExpenseCategory: string{

    case COST_OF_SALES = 'Cost of Sales';
    case SUPPLIES_AND_MATERIALS = 'Supplies and materials';
    case COST_OF_LABOUR = 'Cost of labour';
    case SHIPPING_FREIGHT_AND_DELIVERY = 'Shipping, Freight and Delivery';
    case FREIGHT_AND_DELIVERY = 'Freight and delivery';
    case OTHER_COSTS_OF_SALES = 'Other costs of sales';
    case AMORTISATION_EXPENSE = 'Amortisation expense';
    case BAD_DEBTS = 'Bad debts';
    case BANK_CHARGES = 'Bank charges';
    case COMMISSIONS_AND_FEES = 'Commissions and fees';
    case OTHER_SELLING_EXPENSES = 'Other selling expenses';
    case OFFICE_GENERAL_ADMINISTRATIVE_EXPENSES = 'Office/General Administrative Expenses';
    case PAYROLL_EXPENSES = 'Payroll Expenses';
    case LEGAL_AND_PROFESSIONAL_FEES = 'Legal and professional fees';
    case ADVERTISING_PROMOTIONAL = 'Advertising/Promotional';
    case DUES_AND_SUBSCRIPTIONS = 'Dues and Subscriptions';
    case RENT_OR_LEASE_OF_BUILDINGS = 'Rent or Lease of Buildings';
    case TRAVEL_EXPENSES = 'Travel expenses';
    case SHIPPING_AND_DELIVERY_EXPENSE = 'Shipping and delivery expense';
    case MEALS_AND_ENTERTAINMENT = 'Meals and entertainment';
    case REPAIR_AND_MAINTENANCE = 'Repair and maintenance';
    case EQUIPMENT_RENTAL = 'Equipment rental';
    case OTHER_MISCELLANEOUS_SERVICE_COST = 'Other Miscellaneous Service Cost';
    case INCOME_TAX_EXPENSE = 'Income tax expense';
    case INSURANCE = 'Insurance';
    case INTEREST_PAID = 'Interest paid';
    case LOSS_ON_DISCONTINUED_OPERATIONS_NET_OF_TAX = 'Loss on discontinued operations, net of tax';
    case MANAGEMENT_COMPENSATION = 'Management compensation';
    case UNAPPLIED_CASH_BILL_PAYMENT_EXPENSE = 'Unapplied Cash Bill Payment Expense';
    case UTILITIES = 'Utilities';
    case EXCHANGE_GAIN_OR_LOSS = 'Exchange Gain or Loss';
    case OTHER_EXPENSE = 'Other Expense';
    case PENALTIES_AND_SETTLEMENTS = 'Penalties and settlements';
}
