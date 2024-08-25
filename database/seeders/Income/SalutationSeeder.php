<?php

namespace Database\Seeders\Income;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalutationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('salutations')->insert([
            [
                'salutation' => 'Mr.',
            ],
            [
                'salutation' => 'Ms.',
            ],
            [
                'salutation' => 'Hon.',
            ],
        ]);
    }
}
