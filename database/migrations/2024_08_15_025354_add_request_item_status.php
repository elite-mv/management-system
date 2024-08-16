<?php

use App\Enums\RequestItemStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('request_items', function (Blueprint $table) {
            $table->enum('status',[
                    RequestItemStatus::PENDING->name,
                    RequestItemStatus::APPROVED->name,
                    RequestItemStatus::DISAPPROVED->name,
                    RequestItemStatus::HOLD->name,
                    RequestItemStatus::PRIORITY->name,
            ]);

            $table->text('remarks')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
          Schema::table('request_items', function (Blueprint $table) {
                $table->removeColumn('status');
                $table->removeColumn('remarks');
        });
    }
};
