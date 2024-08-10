<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MeasurementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('measurements')->insert([
            ['name' => 'PIECE/S', 'priority' => 1],
            ['name' => 'BOX/ES', 'priority' => 2],
            ['name' => 'SHEET/S', 'priority' => 3],
            ['name' => 'KILOGRAM/S', 'priority' => 4],
            ['name' => 'LOT', 'priority' => 5],
            ['name' => 'LITER/S', 'priority' => 6],
            ['name' => 'UNKNOWN', 'priority' => 0],
            ['name' => 'DAY/S', 'priority' => 7],
            ['name' => 'UNIT/S', 'priority' => 8],
            ['name' => 'TANK/S', 'priority' => 0],
            ['name' => 'PACK/S', 'priority' => 0],
            ['name' => 'CAN/S', 'priority' => 0],
            ['name' => 'METER/S', 'priority' => 0],
            ['name' => 'MONTH/S', 'priority' => 0],
            ['name' => 'LOAN', 'priority' => 0],
            ['name' => 'LAST PAY', 'priority' => 0],
            ['name' => 'SET/S', 'priority' => 0],
            ['name' => 'REAM/S', 'priority' => 0],
            ['name' => 'BOTTLE/S', 'priority' => 0],
            ['name' => 'ROLL/S', 'priority' => 0],
            ['name' => 'GALLON/S', 'priority' => 0],
        ]
        );
    }
}
