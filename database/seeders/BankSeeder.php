<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bank_names')->insert([
            [
                'name' => 'SECURITY BANK',
                'id' => '1'
            ],
            [
                'name' => 'BDO',
                'id' => 2,
            ],
            [
                'name' => 'METRO BANK',
                'id' => 3,
            ],
            [
                'name' => 'AUB',
                'id' => 4,
            ],
            [
                'name' => 'BPI',
                'id' => 5,
            ],
        ]);

        DB::table('bank_codes')->insert([
            [
                'bank_name_id' => 1,
                'code' => 'SB-GTI-9791'
            ],
            [
                'bank_name_id' => 1,
                'code' => 'SB-RCA-1810'
            ],

            [
                'bank_name_id' => 2,
                'code' => 'BDO-Guntech-0559'
            ],
            [
                'bank_name_id' => 2,
                'code' => 'BDO-GTI-3561'
            ],
            [
                'bank_name_id' => 2,
                'code' => 'BDO-RCA-5143'
            ],
            [
                'bank_name_id' => 2,
                'code' => 'BDO-NOV-2603'
            ],

            [
                'bank_name_id' => 3,
                'code' => 'MTB-GTI-1579'
            ],

            [
                'bank_name_id' => 3,
                'code' => 'MTB-GTIUSD-0619'
            ],

            [
                'bank_name_id' => 4,
                'code' => 'AUB-Ballistic-0494'
            ],
            [
                'bank_name_id' => 4,
                'code' => 'AUB-RCA-7916'
            ],
            [
                'bank_name_id' => 5,
                'code' => 'BPI-RCA-1946'
            ],

        ]);
    }
}
