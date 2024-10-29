<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ArchiveListing;
use Illuminate\View\View;

class ArchiveListingController extends Controller
{
   //Show all archived messages
   public function index(): View
   {
     $archive_listings = ArchiveListing::latest()->with('user','artwork')->get();
       return view ('archive-listings.index', compact('archive_listings'));
   }
}
