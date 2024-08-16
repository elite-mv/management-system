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
        DB::table('banks')->insert([
            ['name' => 'SECURITY BANK', 'code' => 'SB-GTI-9791'],
            ['name' => 'SECURITY BANK', 'code' => 'SB-RCA-1810'],
            ['name' => 'BDO', 'code' => 'BDO-Guntech-0559'],
            ['name' => 'BDO', 'code' => 'BDO-GTI-3561'],
            ['name' => 'BDO', 'code' => 'BDO-RCA-5143'],
            ['name' => 'BDO', 'code' => 'BDO-NOV-2603'],
            ['name' => 'METRO BANK', 'code' => 'MTB-GTI-1579'],
            ['name' => 'METRO BANK', 'code' => 'MTB-GTIUSD-0619'],
            ['name' => 'AUB', 'code' => 'AUB-Ballistic-0494'],
            ['name' => 'AUB', 'code' => 'AUB-RCA-7916'],
            ['name' => 'BPI', 'code' => 'BPI-RCA-1496'],
        ]);
    }
}
