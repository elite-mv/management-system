<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('companies')->insert([
            [
                'logo' => 'GTI_LOGO.png',
                'name' => 'GTI',
                'priority' => '1',
            ],
            [
                'logo' => 'BMS_LOGO.webp',
                'name' => 'BALLISTIC',
                'priority' => '2',
            ],
            [
                'logo' => 'GUNTECH_LOGO.png',
                'name' => 'GUNTECH',
                'priority' => '3',
            ],
            [
                'logo' => 'SOTERIA_LOGO.webp',
                'name' => 'SOTERIA',
                'priority' => '4',
            ],
            [
                'logo' => 'ELITE_ACES_LOGO.png',
                'name' => 'ELITE ACES',
                'priority' => '5',
            ],
            [
                'logo' => 'PERSONAL_LOGO.png',
                'name' => 'PERSONAL',
                'priority' => '6',
            ],
            [
                'logo' => 'OTHERS_LOGO.png',
                'name' => 'OTHERS',
                'priority' => '7',
            ],
        ]
        );
    }
}
