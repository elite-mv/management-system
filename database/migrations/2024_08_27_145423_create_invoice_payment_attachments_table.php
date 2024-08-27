<?php

use App\Enums\Income\AttachmentType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoice_payment_attachments', function (Blueprint $table) {
            $table->id();
            $table->string('file');
            $table->enum('type', [
                AttachmentType::IMAGE->name,
                AttachmentType::FILE->name,
            ]);
            $table->foreignId('invoice_payment_id')->constrained('invoice_payments');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_payment_attachments');
    }
};
