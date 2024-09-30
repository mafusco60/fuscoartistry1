<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
public function index(): View
{
    $artworks = Artwork::latest()->limit(3)->get();
    return view('/pages/index')->with('artworks', $artworks);
}
}
