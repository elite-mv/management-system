<?php

namespace Database\Seeders;

use App\Enums\ExpenseCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExpenseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define the expense categories
        $expenseCategories = [
            '',
            'Cost of Sales',
            'Supplies and materials',
            'Cost of labour',
            'Shipping, Freight and Delivery',
            'Freight and delivery',
            'Other costs of sales',
            'Amortisation expense',
            'Bad debts',
            'Bank charges',
            'Commissions and fees',
            'Other selling expenses',
            'Office/General Administrative Expenses',
            'Payroll Expenses',
            'Legal and professional fees',
            'Advertising/Promotional',
            'Dues and Subscriptions',
            'Rent or Lease of Buildings',
            'Travel expenses',
            'Shipping and delivery expense',
            'Meals and entertainment',
            'Repair and maintenance',
            'Equipment rental',
            'Other Miscellaneous Service Cost',
            'Income tax expense',
            'Insurance',
            'Interest paid',
            'Loss on discontinued operations, net of tax',
            'Management compensation',
            'Unapplied Cash Bill Payment Expense',
            'Utilities',
            'Exchange Gain or Loss',
            'Other Expense',
            'Penalties and settlements',
        ];

        // Insert the expense categories into the database
        foreach ($expenseCategories as $category) {
            DB::table('expense_categories')->insert([
                'name' => $category,
            ]);
        }
    }
}
