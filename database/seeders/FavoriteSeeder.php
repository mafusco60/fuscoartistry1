<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Artwork;
use App\Models\User;


class FavoriteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Get test user
        $testUser = User::where('email', 'test@test.com')->firstOrFail();

        //Get all artwork ids
        $artworkIds = Artwork::pluck('id')->toArray();
        //Get random artwork id
        $randomArtworkIds = array_rand($artworkIds,3);

        //Attach random artwork to test user
        foreach($randomArtworkIds as $artworkId){
            $testUser->favorites()->attach($artworkId);
        }

        //Output success message
        echo "Favorite created for test user\n";
        
    }
}
