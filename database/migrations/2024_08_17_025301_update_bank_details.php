<?php

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

        Schema::table('bank_details', function (Blueprint $table) {
            $table->foreignId('bank_name_id')->constrained('bank_names');
            $table->foreignId('bank_code_id')->nullable()->constrained('bank_codes');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('request_items', function (Blueprint $table) {
            $table->removeColumn('bank_name_id');
            $table->removeColumn('bank_code_id');
        });
    }
};
