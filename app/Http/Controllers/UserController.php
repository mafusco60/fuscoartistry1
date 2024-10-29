<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Favorite;
use App\Models\Artwork;

class UserController extends Controller
{
    public function index() {
        // Fetch users ordered by creation date descending
        $users = User::orderBy('created_at', 'desc')
        ->paginate(15);
      
      // Pass data to the view
        return view('users.index', [
            'users' => $users
        ]);
      }
      public function show(User $user) {
      
        return view('users.show', [
            'user' => $user,
            // 'favorites' => $user->favorites,
            'artworks'=> Artwork::all(),
            'favorites' => $user->favorites()->orderBy('favorites.created_at', 'desc')->paginate(3)
            
      
        ]);
}
}