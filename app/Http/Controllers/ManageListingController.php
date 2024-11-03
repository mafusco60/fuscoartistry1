<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artwork;
use App\Models\Favorite;
use App\Models\ArchiveListing;
use App\Models\ArchiveMessage;
use App\Models\Message;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ManageListingController extends Controller
{
    //Manage Individual Artwork
/* public function show(Artwork $artwork){
  $artwork = Artwork::find($artwork->id);
    return view('/manage-listing/{{$artwork->1d}}', compact('artwork'));
  } */

    
 //@desc show the manage listings index view
  //@route GET /manage-listings
public function index(): View
{

    $favorites = Favorite::all();
    $artworks = Artwork::all();
  
    $artworks = Artwork::orderBy('updated_at', 'desc')->get();
  
    return view('manage-listings.index', compact('artworks', 'favorites'));
  }
  

//@desc archive the artwork listing - deleting the original listing and creating a new archive listing
//@route POST /manage-listings/{{$artwork}}/archive
public function archive(Artwork $artwork): View
 {
    // Create a new archive listing instance
    $archive_listing = new ArchiveListing();
    $artworks = Artwork::all();
    $artwork = Artwork::findorFail($artwork->id);
    $favorites = Favorite::all();
  
    // Set all required fields
    $archive_listing->archive_title = $artwork->title;
    $archive_listing->archive_description = $artwork->description;
    $archive_listing->archive_medium = $artwork->medium;
    $archive_listing->archive_search_tags = $artwork->search_tags;
    $archive_listing->archive_image = $artwork->image;
    $archive_listing->archive_original = $artwork->original; 
    $archive_listing->archive_featured = $artwork->featured;
    $archive_listing->archive_original_substrate = $artwork->original_substrate;
    $archive_listing->archive_original_dimensions = $artwork->original_dimensions;
    $archive_listing->archive_original_price = $artwork->original_price;
    $archive_listing->original_artwork_id = $artwork->id;     
    $archive_listing->created_at = now();
    $archive_listing->updated_at = now();
     
  
    // Save the archive listing
    $archive_listing->save();
  
    // Delete the original  listing
    $artwork->delete();
  
    return view('manage-listings.index', compact ('archive_listing', 'artworks', 'favorites'))->with('message', 'Listing archived successfully');
  }


  //@desc 
  /* public function store(Request $request){
    $formFields = $request->validate([
  
        'archive_title' => 'required',
        'archive_description' => 'required',
        'archive_medium' => 'required',
        'archive_search_tags' => 'required',
        'archive_original' => 'required',
        'archive_image' => 'nullable',
        'archive_original_ubstrate' => 'nullable',
        'archive_original_dimensions' => 'nullable',
        'archive_original_price' => 'nullable',
        'archive_featured' => 'required', 
        'original_artwork_id' => 'nullable'
        
      ]);
  
      if($request->hasFile('archive_image')){
        $image = $request->file('archive_image');
        $filename = time() . '_' . $image->getClientOriginalName();
        $formFields['archive_image'] = $image->storeAs('images', $filename, 'public');
      }
   
      ArchiveListing::create($formFields);
    
        return redirect('manage-listings.index')->with('message', 'Listing archived successfully');
    } */
//@desc restore archive artwork to original listing
//@route POST /archive-listings/{{$archivelisting}}/restore
    /* public function restore(Request $request, ArchiveListing $archivelisting) {
        // Create a new restored artwork instance
        $artwork = new Artwork();
        
        $validator = Validator::make($request->all(), [
          'title' => 'required|max:255',
          'description' => 'required',
      ]);

   
        $artwork->title = $archivelisting->archive_title;
        $artwork->description = $archivelisting->archive_description;
        $artwork->medium = $archivelisting->archive_medium;
        $artwork->search_tags = $archivelisting->archive_search_tags;
        $artwork->image = $archivelisting->archive_image;
        $artwork->original = $archivelisting->archive_original; 
        $artwork->featured = $archivelisting->archive_featured;
        $artwork->original_substrate = $archivelisting->archive_soriginal_ubstrate;
        $artwork->original_dimensions = $archivelisting->archive_original_dimensions;
        $artwork->original_price = $archivelisting->archive_original_price;
        $artwork->id = $archivelisting->original_artwork_id;
        $artwork->created_at = now();
        $artwork->updated_at = now(); 
        
        
        // Save the artwork
        $artwork->save();
      
        // Delete the archived artwork
        $archivelisting->delete();
    
        return redirect('manage-listings.index')   
         
          ->with('message', 'Artwork restored successfully');
      }
         */

    // @desc search for artwork
    // @route GET /manage-listings/search
      public function search(Request $request): View
    {
        $keywords = strtolower(trim($request->input('keywords')));
        $artworks = Artwork::all();
        $favorites = Favorite::all();

        $query = Artwork::query();

        if ($keywords) {
            $query->where(function ($q) use ($keywords) {
                $q->whereRaw('LOWER(title) like ?', ['%' . $keywords . '%'])
                  ->orWhereRaw('LOWER(description) like ?', ['%' . $keywords . '%'])
                  ->orWhereRaw('LOWER(search_tags) like ?', ['%' . $keywords . '%'])
                  ->orWhereRaw('LOWER(original_substrate) like ?', ['%' . $keywords . '%'])
                  ->orWhereRaw('LOWER(original_dimensions) like ?', ['%' . $keywords . '%'])
                  ->orWhereRaw('LOWER(medium) like ?', ['%' . $keywords . '%']);

            });
        }

        $artworks = $query->paginate(12);

        return view('manage-listings.index', compact('artworks', 'favorites'));
    }

    // Other methods...
}

