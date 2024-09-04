<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('requests', function (Blueprint $table) {
            $table->string('released_by')->nullable()->default('mr. rylan c. alingarog');
            $table->string('received_by')->nullable();
            $table->string('audited_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('requests', function (Blueprint $table) {
            $table->dropColumn('released_by');
            $table->dropColumn('received_by');
            $table->dropColumn('audited_by');
        });
    }
};
