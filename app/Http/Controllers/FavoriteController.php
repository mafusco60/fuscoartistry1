<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use App\Models\User;
use App\Models\Admin;
use App\Models\Favorite;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    // @desc  Get all the favorites of the user
    // @route GET /favorites
    public function index(): View
    {
        $user = Auth::user();
        $artworks = Artwork::all();
        
       
        if ($user) {
            $favorites = $user->favorites()->orderBy('favorites.created_at', 'desc')->paginate(3);
        } 
        else {
            return redirect()->route('login')->with('error', 'You need to login to view your favorites');
    }
  
        return view('favorites/index', compact('favorites', 'artworks', 'user'));
    }
    
    // @desc    Create an Artwork favorite
    // @route   POST /favorites/{artwork}
   public function store( Artwork $artwork):RedirectResponse
    {
        $user = Auth::user();

        // Check if the artwork is already a favorite
        if ($user->favorites()->where('artwork_id', $artwork->id)->exists()) {
            return back()->with('error', 'Job is already bookmarked');
        }

        // Create new favorite
        $user->favorites()->attach($artwork->id);

        return redirect()->back()->with('success', 'Artwork added to favorites successfully!');
    }
    
        // @desc    Remove a favorite Artwork
    // @route   DELETE /favorites/{artwork}
    public function destroy(Artwork $artwork): RedirectResponse
    {
        $user = Auth::user();

        // Check if the artwork is not a favorite
        if (!$user->favorites()->where('artwork_id', $artwork->id)->exists()) {
            return back()->with('error', 'Artwork is not a favorite');
        }

        // Remove favorite
        $user->favorites()->detach($artwork->id);

        return back()->with('success', 'Favorite removed successfully!');
    }

    

}
