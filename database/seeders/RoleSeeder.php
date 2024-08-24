<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            ['name' => 'developer'],
            ['name' => 'book keeper'],
            ['name' => 'accountant'],
            ['name' => 'finance'],
            ['name' => 'president'],
            ['name' => 'auditor'],
            ['name' => 'regular'],
            ['name' => 'sales_officer']
        ]
        );
    }
}
