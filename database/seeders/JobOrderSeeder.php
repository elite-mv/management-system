<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('job_orders')->insert([
            ['name' => 'VARIOUS VEHICLES', 'reference' => 'PR23-101', 'client' => 'BUCOR'],
            ['name' => '1 UNIT RESCUE VEHICLE', 'reference' => 'PR23-102', 'client' => 'TABUK CITY'],
            ['name' => '3 UNITS AMBULANCE & 1 UNIT RESCUE VEHICLES', 'reference' => 'PR23-103', 'client' => 'TABUK CITY'],
            ['name' => '1 UNIT RESCUE VEHICLE', 'reference' => 'PR23-104', 'client' => 'MUNICIPALITY OF TANAY'],
            ['name' => '1 UNIT AMBULANCE', 'reference' => 'PR23-105', 'client' => 'BRGY. DIDIPIO'],
            ['name' => '1 UNIT RESCUE VEHICLE', 'reference' => 'PR23-106', 'client' => 'BRGY. DIDIPIO'],
            ['name' => '1 UNIT AMBULANCE', 'reference' => 'PR23-107', 'client' => 'BAYAWAN CITY'],
            ['name' => '1 UNIT MV W/ARMORING PACKAGE', 'reference' => 'PR23-109', 'client' => 'TABUK CITY'],
            ['name' => '1 UNIT RESCUE VEHICLE', 'reference' => 'PR23-110', 'client' => 'BAYAWAN CITY'],
            ['name' => '1 UNIT ARMORED VEHICLE (EOD)', 'reference' => 'PR24-101', 'client' => 'PHIL. NAVY'],
            ['name' => '1 UNIT TRUCK MAINTENANCE, MEDIUM', 'reference' => 'PR24-102', 'client' => 'PHIL. NAVY'],
            ['name' => '2 UNITS TRUCK WATER TANKER', 'reference' => 'PR24-103', 'client' => 'PHIL. NAVY'],
            ['name' => '1 UNIT RECOVERY VEHICLE, 5 TONNER', 'reference' => 'PR24-104', 'client' => 'PHIL. NAVY'],
            ['name' => '1 UNIT ALL TERRAIN SUV 4X4 ARMORED', 'reference' => 'PR24-105', 'client' => 'PHIL. NAVY'],
            ['name' => '6 UNITS MPV', 'reference' => 'PR24-106', 'client' => 'PHIL. NAVY'],
            ['name' => 'MODIFICATION 1 UNIT AMBULANCE', 'reference' => 'PR24-107', 'client' => 'CLINICA ANTIPOLO'],
            ['name' => 'UNKNOWN', 'reference' => 'UNKNOWN', 'client' => 'NULL'],
            ['name' => 'NULL', 'reference' => 'VCP-167', 'client' => 'NULL'],
            ['name' => 'Toyota Super Grandia Black', 'reference' => '2024-MNL-001', 'client' => 'NULL'],
            ['name' => 'Nissan Patrol', 'reference' => '2023-DVO-007', 'client' => 'NULL'],
            ['name' => 'Toyota Prado', 'reference' => '2024-MNL-005', 'client' => 'NULL'],
            ['name' => 'Toyota Fortuner', 'reference' => '2024-MNL-008', 'client' => 'NULL'],
            ['name' => 'Grandia Elite', 'reference' => '2023-DVO-008', 'client' => 'NULL'],
            ['name' => 'Toyota LC200', 'reference' => '2024-DVO-R07', 'client' => 'NULL'],
            ['name' => 'Toyota Grandia', 'reference' => '2024-MNL-002', 'client' => 'NULL'],
        ]);
    }
}
