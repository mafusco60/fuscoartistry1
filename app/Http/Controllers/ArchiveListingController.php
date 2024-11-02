<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use App\Models\Favorite;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\ArchiveListing;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use function Laravel\Prompts\alert;

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

        return view('archive-listings.search', compact('artworks', 'favorites', 'archive_listings'));
    }

    public function restore(Request $request, ArchiveListing $archive_listing) {
      // Create a new restored listing instance
      $artwork = new Artwork();
      $archive_listing = ArchiveListing::findOrFail($archive_listing->id);
      
     /*  $validator = Validator::make($request->all(), [
        'title' => 'required|max:255',
        'description' => 'required',
    ]); */

      // Set all required fields
      $artwork->title = $archive_listing->archive_title;
      $artwork->description = $archive_listing->archive_description;
      $artwork->medium = $archive_listing->archive_medium;
      $artwork->search_tags = $archive_listing->archive_search_tags;
      $artwork->image = $archive_listing->archive_image;
      $artwork->original = $archive_listing->archive_original; 
      $artwork->featured = $archive_listing->archive_featured;
      $artwork->original_substrate = $archive_listing->archive_original_substrate;
      $artwork->original_dimensions = $archive_listing->archive_original_dimensions;
      $artwork->original_price = $archive_listing->archive_original_price;
      
      $artwork->id = $archive_listing->original_artwork_id;
      $artwork->created_at = now();
      $artwork->updated_at = now();
      
      
      // Save the listing
      $artwork->save();
      // $validator->validate();
    
      // Delete the archived listing / not the actual image which stays within the public folder
      $archive_listing->delete();
  
      return redirect('manage-listings')   
       ->with('message', 'Listing restored successfully');
    }
      
   
    
//Delete Listing Data
public function destroy(Request $request, ArchiveListing $archive_listing)
{
  $archive_listing->delete();

  if ($request->query('stay') === ('archive-listings.index')) 
  {
      return redirect('archive-listings.index', compact ('archive_listing'))->with('message', 'Archive Listing deleted successfully');
  }
  if($archive_listing->archive_image && Storage::disk('public')->exists($archive_listing->archive_image)) {
    Storage::disk('public')->delete($archive_listing->archive_image);
}

  return redirect('archive-listings/index')->with('message', 'Listing deleted successfully');

}



  }