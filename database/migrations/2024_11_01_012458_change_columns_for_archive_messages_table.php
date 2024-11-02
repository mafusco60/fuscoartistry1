<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
public function up(): void
    {
        Schema::table('archive_messages', function (Blueprint $table) {

        $table->dropColumn('archive_artwork_id');
            $table->string('archive_artwork_title')->nullable();;
            $table->string('archive_artwork_image')->nullable();;

    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->integer('archive_artwork_id')->nullable();
            $table->dropColumn('archive_artwork_title');
            $table->dropColumn('archive_artwork_image');

        });
    }
};