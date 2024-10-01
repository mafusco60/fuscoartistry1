<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

class HomeController extends Controller
{
/* public function index(): View
{
    $artworks = Artwork::latest()->limit(3)->get();
    return view('/pages/index')->with('artworks', $artworks);
} */
public function index(): View
{
    // Fetch 4 featured artworks
    
$featuredArtworks = Artwork::where('featured', true)
    ->inRandomOrder()
    ->take(4)
    ->get();

    // Fetch 3 recent artworks
    $recentArtworks = Artwork::orderBy('updated_at', 'desc')->take(3)
    ->get();


    // Pass data to the view
    return view('pages.index', [
        'featuredArtworks' => $featuredArtworks,
        'recentArtworks' => $recentArtworks
    ]);
}

}
