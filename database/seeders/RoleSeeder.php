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
            [
                'id' => 1,
                'name' => 'developer'
            ],
            [
                'id' => 2,
                'name' => 'book keeper'
            ],
            [
                'id' => 3,
                'name' => 'accountant'
            ],
            [
                'id' => 4,
                'name' => 'finance'
            ],
            [
                'id' => 5,
                'name' => 'president'
            ],
            [
                'id' => 6,
                'name' => 'auditor'
            ],
            [
                'id' => 7,
                'name' => 'regular'
            ],
        ]
        );
    }
}
