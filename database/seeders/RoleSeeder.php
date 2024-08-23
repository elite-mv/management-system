<?php

namespace Database\Seeders;

use App\Enums\UserRole;
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
                    'name' => UserRole::DEVELOPER->value
                ],
                [
                    'id' => 2,
                    'name' => UserRole::BOOK_KEEPER->value
                ],
                [
                    'id' => 3,
                    'name' => UserRole::ACCOUNTANT->value
                ],
                [
                    'id' => 4,
                    'name' => UserRole::FINANCE->value
                ],
                [
                    'id' => 5,
                    'name' => UserRole::PRESIDENT->value
                ],
                [
                    'id' => 6,
                    'name' => UserRole::AUDITOR->value
                ],
                [
                    'id' => 7,
                    'name' => UserRole::STAFF->value
                ],
            ]
        );
    }
}
