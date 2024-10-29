<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

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

public function search(Request $request): View
    {
      $keywords = strtolower(trim($request->input('keywords')));

        $query = User::query();

        if ($keywords) {
            $query->where(function ($q) use ($keywords) {
                $q->whereRaw('LOWER(firstname) like ?', ['%' . $keywords . '%'])
                ->orWhereRaw('LOWER(lastname) like ?', ['%' . $keywords . '%'])
                 ->orWhereRaw('LOWER(email) like ?', ['%' . $keywords . '%']);
                
                 

                });

          }

        $users = $query->paginate(12);

        return view('users.index', compact ('users'));
    }
}