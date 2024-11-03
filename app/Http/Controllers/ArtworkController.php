<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

use App\Models\Artwork;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class ArtworkController extends Controller
{
    //@desc show the artworks index view
    //@route GET /artworks
    public function index(): View
    {
        $artworks = Artwork::latest()->paginate(9);
        return view('artworks.index')->with('artworks', $artworks);
    }


   //@desc show the create artwork form
    //@route GET /artworks/create
    public function create(): View
    {
        return view('artworks.create');
    }


    //@desc save the artwork listing to database
    //@route POST /artworks
    public function store(Request $request){
        $formFields = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'medium' => 'required|string|max:255',
        'original' => 'required|boolean',
        'featured' => 'required|boolean',
        'search_tags' => 'nullable|string|max:255',
        'original_price' => 'nullable|integer',
        'original_substrate' => 'nullable|string|max:255',
        'original_dimensions' => 'nullable|string|max:255',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
  
    if($request->hasFile('image')){
      $image = $request->file('image');
      $filename = time() . '_' . $image->getClientOriginalName();
      $formFields['image'] = $image->storeAs('images', $filename, 'public');
    }

        $artwork = Artwork::create($formFields);
  
        return redirect()->route('artworks.show', ['artwork' => $artwork->id])->with('success', 'Artwork created successfully');

  }

    //@desc show the individual artwork listing
    //@route GET /artworks/{$id}
    public function show(Artwork $artwork) : View
    {
        $artwork = Artwork::findOrFail($artwork->id);
        return view ('artworks.show', compact ('artwork'));
    }

    
    //@desc show the edit artwork form
    //@route GET /artworks/{$id}/edit
    public function edit(Artwork $artwork): View
    {
        return view('artworks.edit')->with('artwork', $artwork);
    }

    //@desc save the updated artwork listing to database
    //@route PUT /artworks/{$id}
    public function update(Request $request, Artwork $artwork): RedirectResponse
    {
        $formFields = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'medium' => 'required|string|max:255',
            'original' => 'required|boolean',
            'featured' => 'required|boolean',
            'search_tags' => 'nullable|string|max:255',
            'original_price' => 'nullable|integer',
            'original_substrate' => 'nullable|string|max:255',
            'original_dimensions' => 'nullable|string|max:255',
              'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        
          ]);
      
          //Save the new image
            if ($request->hasFile('image')) {
                // Get the new image
                $image = $request->file('image');
                $filename = time() . '_' . $image->getClientOriginalName();
                $formFields['image'] = $image->storeAs('images', $filename, 'public');
                //Check if a new image has been uploaded
                // Delete the old image
                if ($artwork->image && Storage::disk('public')->exists($artwork->image)) {
                    Storage::disk('public')->delete($artwork->image);
                }
            }
            
            // Update the artwork
            $artwork->update($formFields);
     
            return redirect()->route('artworks.show', ['artwork' => $artwork->id])->with('success', 'Artwork updated successfully');

        
    }


   //@desc delete the artwork listing from database
    //@route DELETE /artworks/{$id}
    public function destroy(Artwork $artwork): RedirectResponse
        {
        //If image exists, delete it
            if($artwork->image){
                Storage::disk('public')->delete($artwork->image);
            }
        $artwork->delete();

         return redirect()->route('artworks.index')->with('success', 'Artwork listing deleted successfully');

    }

   

    //@desc search for artwork listings
    //@route GET /artworks/search
   /*  public function search(Request $request): View
    {
        $keywords = strtolower(trim($request->input('keywords')));
        $query = Artwork::query();

        if ($keywords) {
            $query->where(function($q) use ($keywords) {
                $q->where('description', 'LIKE', '%' . $keywords . '%')
                  ->orWhere('title', 'LIKE', '%' . $keywords . '%')
                  ->orWhere('medium', 'LIKE', '%' . $keywords . '%')
                  ->orWhere('search_tags', 'LIKE', '%' . $keywords . '%')
                  ->orWhere('original_substrate', 'LIKE', '%' . $keywords . '%')
                  ->orWhere('original_dimensions', 'LIKE', '%' . $keywords . '%');
            });
        }

        $artworks = $query->paginate(9);

        return view('artworks.index', compact('artworks'));
    } */
    public function search(Request $request): View
    {
        $keywords = strtolower (trim($request->input('keywords')));

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

        return view('artworks.index')->with('artworks', $artworks);
    }
}

