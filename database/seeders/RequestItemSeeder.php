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
            ->count(10000)
            ->has(RequestItem::factory()->count(10), 'items')
            ->has(RequestApproval::factory(),'approvals')
            ->create();
    }
}
