<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ArtworkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $artworks = [
            'Mona Lisa',
            'The Starry Night',
            'The Scream',
            'The Persistence of Memory',
        ];
        return view('artworks.index', compact('artworks'));
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
    public function store(Request $request): string
    {
        return "store";
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) : string
    {
        return "show";
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
