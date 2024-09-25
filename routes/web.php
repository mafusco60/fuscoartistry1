<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtworkController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'] ); 

Route::resource('artworks', ArtworkController::class);


