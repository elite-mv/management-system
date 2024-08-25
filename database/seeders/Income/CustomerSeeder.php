<?php

namespace Database\Seeders\Income;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('customers')->insert([
            [
                'name' => 'Ms. April Jane',
                'position' => 'Admin',
                'company' => 'Elite Aces Trading Inc.',
                'email' => 'april@eliteacesinc.com',
                'contact_number' => '+63 9',
                'address' => 'Philippines',
                'currency' => 'PHP'
            ],
            [
                'name' => 'Ms. Jocelyn Compoto',
                'position' => 'Secretary',
                'company' => 'Elite Aces Trading Inc.',
                'email' => 'jocelyn@eliteacesinc.com',
                'contact_number' => '+63 9',
                'address' => 'Philippines',
                'currency' => 'PHP'
            ],
            [
                'name' => 'Ms. Armorbelle Dijamco',
                'position' => 'General Manager',
                'company' => 'Elite Aces Trading Inc.',
                'email' => 'armorbelle@eliteacesinc.com',
                'contact_number' => '+63 9',
                'address' => 'Philippines',
                'currency' => 'PHP'
            ],
        ]);

    }
}
