<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class user_seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('users')->insert([
            'name' => 'john',
            'email' => 'john.castillo@eliteacesinc.com',
            'role_id' => 1,
            'email_verified_at' => Carbon::now()->toDateTime(),
            'password' => bcrypt('testpassword123'),
        ],
        [
            'name' => 'Tester',
            'email' => 'test@president.com',
            'role_id' => 7,
            'email_verified_at' => Carbon::now()->toDateTime(),
            'password' => bcrypt('qazws123'),
        ]
    );
    }
}
