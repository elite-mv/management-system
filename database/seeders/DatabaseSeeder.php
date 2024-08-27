<?php

namespace Database\Seeders;

use App\Models\Income\Currency;
use Database\Seeders\Income\CurrencySeeder;
use Database\Seeders\Income\CustomerSeeder;
use Database\Seeders\Income\SalutationSeeder;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            CompanySeeder::class,
            JobOrderSeeder::class,
            MeasurementSeeder::class,
            RoleSeeder::class,
            user_seeder::class,
            BankSeeder::class,
            ExpenseCategorySeeder::class,
            CurrencySeeder::class,
            CustomerSeeder::class,
            SalutationSeeder::class,
            RequestItemSeeder::class,
        ]);

    }
}
