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
            $table->string('request_by')->index()->nullable();
            $table->string('reference')->index()->nullable();
            $table->foreignId('prepared_by')->nullable()->constrained('users');
            $table->foreignId('company_id')->nullable()->constrained();

            $table->enum('priority_level',[
                RequestPriorityLevel::NONE->name,
                RequestPriorityLevel::LOW->name,
                RequestPriorityLevel::MEDIUM->name,
                RequestPriorityLevel::HIGH->name,
            ]);

            $table->enum('payment_method',[
                PaymentMethod::NONE->value,
                PaymentMethod::CASH->value,
                PaymentMethod::CHECK->value,
                PaymentMethod::CREDIT_CARD->value,
                PaymentMethod::GCASH->value,
                PaymentMethod::ONLINE_TRANSFER->value,
            ]);

            $table->boolean('priority');
            $table->string('others')->nullable();
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
