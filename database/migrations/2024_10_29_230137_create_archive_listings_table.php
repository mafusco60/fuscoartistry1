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
        Schema::create('archive_listings', function (Blueprint $table) {
            $table->id();
            $table->string('archive_title');
            $table->text('archive_description');
            $table->string('archive_medium');
            $table->string('archive_search_tags');
            $table->string('archive_image');
            $table->boolean('archive_original');
            $table->boolean('archive_featured');
            $table->string('archive_original_substrate')->nullable();
            $table->string('archive_original_dimensions')->nullable();
            $table->decimal('archive_original_price', 8, 2)->nullable();
            $table->unsignedBigInteger('original_artwork_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('archive_listings');
    }
};

