<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artwork;
use App\Models\Favorite;
use App\Models\ArchiveListing;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\View\View;

class ManageListingController extends Controller
{
    //Manage Individual Artwork
public function show(Artwork $artwork){
    return view('/manage-listings/{artwork}', compact('artwork'));
  }

    
  //Manage Artworks
public function index(){

    $favorites = Favorite::all();
    $artworks = Artwork::all();
  
    $artworks = Artwork::orderBy('updated_at', 'desc')->get();
  
    return view('/manage-listings.index', compact('artworks', 'favorites'));
  }
  


public function archive(artwork $artwork) {
    // Create a new archive listing instance
    $archivelisting = new ArchiveListing();
  
    // Set all required fields
    $archivelisting->archive_title = $artwork->title;
    $archivelisting->archive_description = $artwork->description;
    $archivelisting->archive_medium = $artwork->medium;
    $archivelisting->archive_search_tags = $artwork->search_tags;
    $archivelisting->archive_image = $artwork->image;
    $archivelisting->archive_original = $artwork->original; 
    $archivelisting->archive_featured = $artwork->featured;
    $archivelisting->archive_original_substrate = $artwork->original_substrate;
    $archivelisting->archive_original_dimensions = $artwork->original_dimensions;
    $archivelisting->archive_original_price = $artwork->original_price;
    $archivelisting->originallisting_id = $artwork->id;
/*     $archivelisting->created_at = now();
    $archivelisting->updated_at = now();
 */    
  
    // Save the archive listing
    $archivelisting->save();
  
    // Delete the original  listing
    $artwork->delete();
  
    return redirect('manage-listings.index')->with('message', 'Listing archived successfully');
  }
  public function store(Request $request){
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
        'originallisting_id' => 'nullable'
        
      ]);
  
      if($request->hasFile('archive_image')){
        $image = $request->file('archive_image');
        $filename = time() . '_' . $image->getClientOriginalName();
        $formFields['archive_image'] = $image->storeAs('images', $filename, 'public');
      }
   
      ArchiveArtwork::create($formFields);
    
        return redirect('manage-listings.index')->with('message', 'Listing archived successfully');
    }

    public function restore(Request $request, ArchiveArtwork $archivelisting) {
        // Create a new restored artwork instance
        $artwork = new Artwork();
        
        $validator = Validator::make($request->all(), [
          'title' => 'required|max:255',
          'description' => 'required',
      ]);

        // Set all required fields
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
        $artwork->id = $archivelisting->originallisting_id;
        /* $artwork->created_at = now();
        $artwork->updated_at = now(); */
        
        
        // Save the artwork
        $artwork->save();
      
        // Delete the archived artwork
        $archivelisting->delete();
    
        return redirect('manage-listings.index')   
         
          ->with('message', 'Artwork restored successfully');
      }
        
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

