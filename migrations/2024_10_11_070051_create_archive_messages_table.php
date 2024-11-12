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
        Schema::create('archive_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('archive_sender_id')->constrained('users');
            $table->foreignId('archive_listing_id')->constrained('artworks');
            $table->string('archive_name');
            $table->string('archive_email');
            $table->string('archive_subject');
            $table->text('archive_body');
            $table->string('archive_upload')->nullable();
            $table->text('archive_reply')->nullable();
            $table->timestamp('original_creation_date');
            $table->timestamp('reply_creation_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('archive_messages');
    }
};
