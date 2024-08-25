<?php

namespace Database\Seeders;

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
            RequestItemSeeder::class
        ]);

    }
}
