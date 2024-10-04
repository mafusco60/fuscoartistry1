<?php

namespace App\Http\Controllers;
use App\Models\Artwork;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class FavoriteController extends Controller
{
    public function index(User $user)
    {
        $favorites = $user->favorites()->get();
        return view('favorites.index')->with('favorites', $favorites);
    }
    
   public function store(Artwork $artwork)
    {
     
        return back();
    }

    public function destroy(Artwork $artwork)
    {
    
        return back();
    }

}
