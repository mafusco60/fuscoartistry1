<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //Clear table data
        DB::table('artworks')->truncate();

        Schema::table('artworks', function (Blueprint $table) {


          $table->enum('medium', [
            'Digital Art', 'Mixed Media', 'Oil Painting', 'Watercolor', 'Acrylic Painting', 'Oil Pastel', 'Soft Pastel','Charcoal', 'Graphite', 'Color Pencil', 'Ink', 'Alcohol Marker', 'Other',
          ])->default('Other')->after('title');

        

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('artworks', function (Blueprint $table) {
            $table->dropColumn('medium');
            //
        });
    }
};
