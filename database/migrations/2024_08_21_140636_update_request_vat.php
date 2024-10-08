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
        Schema::table('request_vats', function (Blueprint $table) {
            $table->string('option_a')->nullable();
            $table->string('option_b')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('request_vats', function (Blueprint $table) {
            $table->dropColumn('option_a');
            $table->dropColumn('option_b');
        });
    }
};
