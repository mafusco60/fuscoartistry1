<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtworkController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\MessageController;

Route::get('/', [HomeController::class, 'index'] )->name('home'); 

Route::resource('artworks', ArtworkController::class);

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
Route::get('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');
Route::get('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');

Route::middleware('auth')->group(function(){
  Route::get('/favorites/index', [FavoriteController::class, 'index'])->name('favorites.index');
  Route::post('/favorites/{artwork}', [FavoriteController::class, 'store'])->name('favorites.store');
  Route::delete('/favorites/{artwork}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
});



Route::post('/', [MessageController::class, 'store'])->name('message.store');
Route::get('/messages/create', [MessageController::class, 'create'])->name('messages.create');

// Route::post('/', [MessageController::class, 'store'])->name('message.store');
Route::get('/artworks/{artwork}/messages/create', [MessageController::class, 'create'])->name('messages.create');