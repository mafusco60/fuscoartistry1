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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sender_id')->constrained('users')->nullable();
            $table->foreignId('artwork_id')->constrained('artworks')->nullable();
            $table->string('name');
            $table->string('email');
            $table->text('body');
            $table->string('phone')->nullable();
            $table->string('subject')->nullable();
          
            
            $table->string('image')->nullable();
            $table->boolean('read')->default(false);
            $table->text('reply')->nullable();
            $table->boolean('archived')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('message');
    }
};
