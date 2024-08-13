<?php

use App\Enums\RequestPriorityLevel;
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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->string('supplier');
            $table->string('paid_to');
            $table->string('request_by');
            $table->foreignId('prepared_by')->constrained('users');
            $table->foreignId('company_id')->constrained();
            $table->enum('priority_level',[
                RequestPriorityLevel::NONE->name,
                RequestPriorityLevel::LOW->name,
                RequestPriorityLevel::MEDUIM->name,
                RequestPriorityLevel::HIGH->name,
            ]);

            $table->boolean('priority');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
