<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Truncate tables
        DB::table('users')->truncate();
        DB::table('favorites')->truncate();

        $this->call(TestUserSeeder::class);
        $this->call(FavoriteSeeder::class);



    }
}
