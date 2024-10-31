<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

use App\Models\ArchiveListing;
use App\Models\Artwork;
use App\Models\Favorite;


class ArchiveListingController extends Controller
{
   //Show all archived messages
   public function index(Request $request): View
   {
     $archive_listings = ArchiveListing::latest()/* >with('user','artwork') */->get();


       return view ('archive-listings.index', compact('archive_listings'));
   }

// @desc search for artwork
    // @route GET /archive-listings/search
    public function search(Request $request): View
    {
        $keywords = strtolower(trim($request->input('keywords')));
        $archive_listings = ArchiveListing::all();
        $favorites = Favorite::all();
        $artworks = Artwork::all();

       

        $query = ArchiveListing::query();

        if ($keywords) {
            $query->where(function ($q) use ($keywords) {
                $q->whereRaw('LOWER(archive_title) like ?', ['%' . $keywords . '%'])
                  ->orWhereRaw('LOWER(archive_description) like ?', ['%' . $keywords . '%'])
                  ->orWhereRaw('LOWER(archive_search_tags) like ?', ['%' . $keywords . '%'])
                  ->orWhereRaw('LOWER(archive_original_substrate) like ?', ['%' . $keywords . '%'])
                  ->orWhereRaw('LOWER(archive_original_dimensions) like ?', ['%' . $keywords . '%'])
                  ->orWhereRaw('LOWER(archive_medium) like ?', ['%' . $keywords . '%']);

            });
        }

        $artworks = $query->paginate(12);

        return view('archive-listings.index', compact('artworks', 'favorites', 'archive_listings'));
    }

  }