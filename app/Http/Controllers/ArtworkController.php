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
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $artworks = Artwork::all();
        return view('artworks.index')->with('artworks', $artworks);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('artworks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeBRAD(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
        ]);

        Artwork::create ([
            'title' =>  $validatedData ['title'],
            'description' => $validatedData ['description'],

        ]);

        return redirect()->route('artworks.index');
    }

//Store Listings
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
  
    //   return redirect()-> route('artworks.index') ->with('success', 'Artwork created successfully');

      return redirect()->route('artworks.show', ['artwork' => $artwork->id])->with('success', 'Artwork created successfully');

  }

    /**
     * Display the specified resource.
     */
    public function show(Artwork $artwork) : View
    {
        return view ('artworks.show')->with('artwork', $artwork);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Artwork $artwork): View
    {
        return view('artworks.edit')->with('artwork', $artwork);
    }

    /**
     * Update the specified resource in storage.
     */
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
        
        //Check if a new image has been uploaded
        //   if($request->hasFile('image')){
        //Delete the old image
            // Storage::delete($artwork->image);

            
            if ($request->hasFile('image')) {
                // Get the new image
                $image = $request->file('image');
                $filename = time() . '_' . $image->getClientOriginalName();
                $formFields['image'] = $image->storeAs('images', $filename, 'public');
            
                // Delete the old image
                if ($artwork->image && Storage::disk('public')->exists($artwork->image)) {
                    Storage::disk('public')->delete($artwork->image);
                }
            }
            
            // Update the artwork
            $artwork->update($formFields);
        //Update the artwork
          $artwork->update($formFields);
        
     
            return redirect()->route('artworks.show', ['artwork' => $artwork->id])->with('success', 'Artwork updated successfully');

        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Artwork $artwork): RedirectResponse
    {
       //If image exists, delete it
       if($artwork->image){
        Storage::disk('public')->delete($artwork->image);
       }
       $artwork->delete();

         return redirect()->route('artworks.index')->with('success', 'Artwork listing deleted successfully');

    }
}
