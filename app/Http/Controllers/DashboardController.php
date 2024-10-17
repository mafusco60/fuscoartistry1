<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Artwork;
use App\Models\User;


class DashboardController extends Controller
{
    // @desc show the dashboard view
    // @route GET /dashboard
    public function index(): View
    {
               // Get logged in user
               $user = Auth::user();
               $favorites = $user->favorites;

               // Get the user listings
/*                $artworks = Artwork::where('user_id', $user->id)->with('')->get(); */
                $artworks = Artwork::get();
       
               return view('dashboard', compact('user', 'artworks', 'favorites'));
    }
   
}
