<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use App\Models\User;
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

        $favorites = $user->favorites()->orderBy('favorites.created_at', 'desc')->paginate(9);

         return view('favorites/index')->with('favorites', $favorites);
    }
    
   public function store( Artwork $artwork):RedirectResponse
    {
        $user = Auth::user();

        // Check if the job is already bookmarked
        if ($user->favorites()->where('artwork_id', $artwork->id)->exists()) {
            return back()->with('error', 'Job is already bookmarked');
        }

        // Create new bookmark
        $user->favorites()->attach($artwork->id);

        return back()->with('success', 'Artwork added to favorites successfully!');
    }
    
        // @desc    Remove bookmarked job
    // @route   DELETE /bookmarks/{job}
    public function destroy(Artwork $artwork): RedirectResponse
    {
        $user = Auth::user();

        // Check if the job is not bookmarked
        if (!$user->favorites()->where('artwork_id', $artwork->id)->exists()) {
            return back()->with('error', 'Artwork is not a favorite');
        }

        // Remove bookmark
        $user->favorites()->detach($artwork->id);

        return back()->with('success', 'Favorite removed successfully!');
    }

}
