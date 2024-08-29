<?php

namespace Database\Seeders;

use App\Models\Expense\Request;
use App\Models\Expense\RequestApproval;
use App\Models\Expense\RequestItem;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

class RequestItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Request::factory()
            ->count(100000)
            ->has(RequestItem::factory()->count(10), 'items')
            ->has(RequestApproval::factory()->count(5)->sequence(
                ['role_id' => 2],
                ['role_id' => 3],
                ['role_id' => 4],
                ['role_id' => 5],
                ['role_id' => 6],
            ),'approvals')
            ->create();
    }
}
