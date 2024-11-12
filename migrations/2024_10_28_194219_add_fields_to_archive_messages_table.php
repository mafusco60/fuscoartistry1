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
        Schema::table('archive_messages', function (Blueprint $table) {
            $table->string('archive_phone')->nullable();
            $table->string('archive_read')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('archive_messages', function (Blueprint $table) {
            $table->dropColumn('archive_phone');
            $table->dropColumn('archive_read');
        });
    }
};
