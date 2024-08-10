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
        Schema::table('request_items', function (Blueprint $table) {
            $table->foreignId('request_id')->nullable()->constrained();
            $table->string('session_id')->index();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('request_items', function (Blueprint $table) {
            if(Schema::hasColumn('request_items','session_id')){
                $table->removeColumn('request_id');
                $table->removeColumn('session_id');
            }
        });
    }
};
