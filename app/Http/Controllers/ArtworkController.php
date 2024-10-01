<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

use App\Models\Artwork;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

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
  
  
    Artwork::create($formFields);
  
      return redirect()-> route('artworks.index') ->with('success', 'Artwork created successfully');
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
    public function edit(string $id): string
    {
        return "edit";
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): string
    {
        return "update";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): string
    {
        return "destroy";
    }
}
