<?php

use App\Enums\PaymentMethod;
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
            $table->string('supplier')->nullable();
            $table->string('paid_to')->nullable();
            $table->string('request_by')->nullable();
            $table->foreignId('prepared_by')->nullable()->constrained('users');
            $table->foreignId('company_id')->nullable()->constrained();

            $table->enum('priority_level',[
                RequestPriorityLevel::NONE->name,
                RequestPriorityLevel::LOW->name,
                RequestPriorityLevel::MEDIUM->name,
                RequestPriorityLevel::HIGH->name,
            ]);

            $table->enum('payment_method',[
                PaymentMethod::NONE->name,
                PaymentMethod::CASH->name,
                PaymentMethod::CHECK->name,
                PaymentMethod::CREDIT_CARD->name,
                PaymentMethod::GCASH->name,
                PaymentMethod::ONLINE_TRANSFER->name,
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
