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
        Schema::table('messages', function (Blueprint $table) {

        $table->dropColumn('artwork_id');
            $table->string('artwork_title')->nullable();
            $table->string('artwork_image')->nullable();;

    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->integer('artwork_id')->nullable();
            $table->dropColumn('artwork_title');
            $table->dropColumn('artwork_image');

        });
    }
};

    
