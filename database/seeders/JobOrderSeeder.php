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
            [
                'id' => 1,
                'reference' => 'PR23-101',
                'name' => 'VARIOUS VEHICLES',
                'client' => 'BUCOR',
            ],
            [
                'id' => 2,
                'reference' => 'PR23-102',
                'name' => '1 UNIT RESCUE VEHICLE',
                'client' => 'TABUK CITY',
            ],
            [
                'id' => 3,
                'reference' => 'PR23-103',
                'name' => '3 UNITS AMBULANCE & 1 UNIT RESCUE VEHICLES',
                'client' => 'TABUK CITY',
            ],
            [
                'id' => 4,
                'reference' => 'PR23-104',
                'name' => '1 UNIT RESCUE VEHICLE',
                'client' => 'MUNICIPALITY OF TANAY',
            ],
            [
                'id' => 5,
                'reference' => 'PR23-105',
                'name' => '1 UNIT AMBULANCE',
                'client' => 'BRGY. DIDIPIO',
            ],
            [
                'id' => 6,
                'reference' => 'PR23-106',
                'name' => '1 UNIT RESCUE VEHICLE',
                'client' => 'BRGY. DIDIPIO',
            ],
            [
                'id' => 7,
                'reference' => 'PR23-107',
                'name' => '1 UNIT AMBULANCE',
                'client' => 'BAYAWAN CITY',
            ],
            [
                'id' => 8,
                'reference' => 'PR23-109',
                'name' => '1 UNIT MV W/ARMORING PACKAGE',
                'client' => 'TABUK CITY',
            ],
            [
                'id' => 9,
                'reference' => 'PR23-110',
                'name' => '1 UNIT RESCUE VEHICLE',
                'client' => 'BAYAWAN CITY',
            ],
            [
                'id' => 10,
                'reference' => 'PR24-101',
                'name' => '1 UNIT ARMORED VEHICLE (EOD)',
                'client' => 'PHIL. NAVY',
            ],
            [
                'id' => 11,
                'reference' => 'PR24-102',
                'name' => '1 UNIT TRUCK MAINTENANCE, MEDIUM',
                'client' => 'PHIL. NAVY',
            ],
            [
                'id' => 12,
                'reference' => 'PR24-103',
                'name' => '2 UNITS TRUCK WATER TANKER',
                'client' => 'PHIL. NAVY',
            ],
            [
                'id' => 13,
                'reference' => 'PR24-104',
                'name' => '1 UNIT RECOVERY VEHICLE, 5 TONNER',
                'client' => 'PHIL. NAVY',
            ],
            [
                'id' => 14,
                'reference' => 'PR24-105',
                'name' => '1 UNIT ALL TERRAIN SUV 4X4 ARMORED',
                'client' => 'PHIL. NAVY',
            ],
            [
                'id' => 15,
                'reference' => 'PR24-106',
                'name' => '6 UNITS MPV',
                'client' => 'PHIL. NAVY',
            ],
            [
                'id' => 16,
                'reference' => 'PR24-107',
                'name' => 'MODIFICATION 1 UNIT AMBULANCE',
                'client' => 'CLINICA ANTIPOLO',
            ],
            [
                'id' => 17,
                'reference' => 'UNKNOWN',
                'name' => 'NULL',
                'client' => 'NULL',
            ],
            [
                'id' => 18,
                'reference' => 'VCP-167',
                'name' => 'UNIT',
                'client' => '',
            ],
            [
                'id' => 19,
                'reference' => '2024-MNL-001',
                'name' => 'Toyota Super Grandia Black',
                'client' => '',
            ],
            [
                'id' => 20,
                'reference' => '2023-DVO-007',
                'name' => 'Nissan Patrol',
                'client' => '',
            ],
            [
                'id' => 21,
                'reference' => '2024-MNL-005',
                'name' => 'Toyota Prado',
                'client' => '',
            ],
            [
                'id' => 22,
                'reference' => '2024-MNL-008',
                'name' => 'Toyota Fortuner',
                'client' => '',
            ],
            [
                'id' => 23,
                'reference' => '2023-DVO-008',
                'name' => 'Grandia Elite',
                'client' => '',
            ],
            [
                'id' => 24,
                'reference' => '2024-DVO-R07',
                'name' => 'Toyota LC200',
                'client' => '',
            ],
            [
                'id' => 25,
                'reference' => '2024-MNL-002',
                'name' => 'Toyota Grandia',
                'client' => '',
            ],
            [
                'id' => 26,
                'reference' => '2023-DVO-009',
                'name' => 'Mazda',
                'client' => '',
            ],
            [
                'id' => 27,
                'reference' => '2024-DVO-002',
                'name' => 'Isuzu Max',
                'client' => '',
            ],
            [
                'id' => 28,
                'reference' => '2023-MNL-026',
                'name' => 'Grandia Tourer',
                'client' => '',
            ],
            [
                'id' => 29,
                'reference' => '2024-MNL-006',
                'name' => '',
                'client' => '',
            ],
            [
                'id' => 30,
                'reference' => '2024-MNL-007',
                'name' => '',
                'client' => '',
            ],
            [
                'id' => 31,
                'reference' => '2023-MNL-024',
                'name' => 'Nissan Patrol',
                'client' => '',
            ],
            [
                'id' => 32,
                'reference' => '2024-MNL-R21',
                'name' => 'FORTUNER',
                'client' => '',
            ],
            [
                'id' => 33,
                'reference' => '2024-DVO-001',
                'name' => 'TOYOTA LC200',
                'client' => '',
            ],
            [
                'id' => 34,
                'reference' => '2024-DVO-003',
                'name' => 'TOYOTA LC200',
                'client' => '',
            ],
            [
                'id' => 35,
                'reference' => '2024-DVO-R2',
                'name' => 'FORD EVEREST',
                'client' => '',
            ],
            [
                'id' => 36,
                'reference' => '2024-DVO-R6',
                'name' => 'TOYOTA FORTUNER',
                'client' => '',
            ],
            [
                'id' => 37,
                'reference' => '2023-MNL-022',
                'name' => 'TOYOTA GRANDIA ELITE',
                'client' => '',
            ],
            [
                'id' => 38,
                'reference' => 'CONSUMABLES',
                'name' => '',
                'client' => '',
            ],
            [
                'id' => 39,
                'reference' => 'OFFICE SUPPLIES',
                'name' => '',
                'client' => '',
            ],
            [
                'id' => 40,
                'reference' => '2024-MNL-R22',
                'name' => 'GRANDIA ELITE',
                'client' => '',
            ],
            [
                'id' => 41,
                'reference' => 'NBB2359-Toyota Fortuner-2018 Brown',
                'name' => 'Toyota Fortuner',
                'client' => 'Angelina Bautista',
            ],
            [
                'id' => 42,
                'reference' => '2024-MNL-009',
                'name' => 'TOYOTA LC300 ZX 2024 MODEL',
                'client' => '',
            ],
            [
                'id' => 43,
                'reference' => '2024-MNL-010',
                'name' => 'FORD EVEREST',
                'client' => '',
            ],
            [
                'id' => 44,
                'reference' => '2024-MNL-011',
                'name' => 'TOYOTA PRADO',
                'client' => '',
            ],
            [
                'id' => 45,
                'reference' => 'PR24-108',
                'name' => '7 UNITS MPV',
                'client' => 'PHILIPPINE NAVY',
            ],
            [
                'id' => 46,
                'reference' => '2024-MNL-012',
                'name' => 'FORD RAPTOR',
                'client' => '',
            ],
            [
                'id' => 47,
                'reference' => '2024-MNL-013',
                'name' => '',
                'client' => '',
            ],
            [
                'id' => 48,
                'reference' => '2024-MNL-014',
                'name' => '',
                'client' => '',
            ],
            [
                'id' => 49,
                'reference' => '2024-DVO-004',
                'name' => '',
                'client' => '',
            ],
            [
                'id' => 50,
                'reference' => '2024-DVO-005',
                'name' => '',
                'client' => '',
            ],
            [
                'id' => 51,
                'reference' => '2024-MNL-015',
                'name' => '',
                'client' => '',
            ],
            [
                'id' => 52,
                'reference' => '2024-MNL-016',
                'name' => '',
                'client' => '',
            ],
            [
                'id' => 53,
                'reference' => '2024-MNL-017',
                'name' => '',
                'client' => '',
            ],
            [
                'id' => 54,
                'reference' => '2024-MNL-018',
                'name' => '',
                'client' => '',
            ],
            [
                'id' => 55,
                'reference' => '2024-DVO-006',
                'name' => '',
                'client' => '',
            ],
            [
                'id' => 56,
                'reference' => '2024-DVO-007',
                'name' => '',
                'client' => '',
            ],
            [
                'id' => 57,
                'reference' => '2024-DVO-008',
                'name' => '',
                'client' => '',
            ],
            [
                'id' => 58,
                'reference' => '2024-DVO-009',
                'name' => '',
                'client' => '',
            ],
            [
                'id' => 59,
                'reference' => '2024-DVO-010',
                'name' => '',
                'client' => '',
            ],
            [
                'id' => 60,
                'reference' => '2024-DVO-011',
                'name' => '',
                'client' => '',
            ],
            [
                'id' => 61,
                'reference' => '2024-MNL-019',
                'name' => '',
                'client' => '',
            ],
            [
                'id' => 62,
                'reference' => '2024-MNL-020',
                'name' => '',
                'client' => '',
            ],
        ]);
    }
}
