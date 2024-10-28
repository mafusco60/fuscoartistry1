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
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ArchiveMessageController;
use App\Http\Controllers\AdminProfileController;


Route::get('/', [HomeController::class, 'index'] )->name('home'); 

Route::get('/artworks/search', [ArtworkController::class, 'search'])->name('artworks.search'); 

Route::get('/messages/search', [MessageController::class, 'search'])->name('messages.search'); 

Route::get('/archive-messages/search', [ArchiveMessageController::class, 'search'])->name('archive-messages.search'); 

Route::resource('artworks', ArtworkController::class);
Route::get('/artworks/{artwork}', [ArtworkController::class, 'show'])->name('artworks.show'); 

Route::get('/login', [LoginController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
Route::get('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::put('/profiles', [ProfileController::class, 'update'])->name('profiles.update')->middleware('auth');
Route::get('/profiles', [ProfileController::class, 'update'])->name('profiles.update')->middleware('auth');

Route::middleware('auth' )->group(function(){
  Route::get('/favorites/index', [FavoriteController::class, 'index'])->name('favorites.index');
  Route::post('/favorites/{artwork}', [FavoriteController::class, 'store'])->name('favorites.store');
  Route::delete('/favorites/{artwork}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
});


Route::get('/messages/create', [MessageController::class, 'create'])->name('messages.create');
Route::post('/messages/store', [MessageController::class, 'store'])->name('messages.store');
Route::delete('/messages/{message}/destroy', [MessageController::class, 'destroy'])->name('messages.destroy')->middleware ('auth:admin');

Route::get('/artworks/{artwork}/messages/create', [MessageController::class, 'createFromArtwork'])->name('artworks-messages.create');
Route::post('/artworks/{artwork}/messages/store', [MessageController::class, 'storeFromArtwork'])->name('artworks-messages.store');
Route::get('/artworks/{artwork}/messages/store', [MessageController::class, 'storeFromArtwork'])->name('artworks-messages.store');

Route::get('/messages', [MessageController::class, 'index'])->name('messages.index')->middleware('auth:admin');

Route::get('/messages/{message}/edit', [MessageController::class, 'edit'])->name('messages.edit')->middleware('auth:admin');

Route::put('/messages/{message}/update', [MessageController::class, 'update'])->name('messages.update')->middleware('auth:admin');

Route::post('/messages/{message}/archive', [MessageController::class, 'archive'])->name('messages.archive')->middleware('auth:admin');

// Archive Messages
Route::get('/archive-messages', [ArchiveMessageController::class, 'index'])->name('archive-messages.index')->middleware('auth:admin');

Route::post('/archive-messages/{archive_message}/restore', [ArchiveMessageController::class, 'restore'])->name('archive-messages.restore')->middleware('auth:admin');

Route::delete('/archive-messages/{archive_message}/delete', [ArchiveMessageController::class, 'destroy'])->name('archive-messages.destroy')->middleware('auth:admin');

/* Route::get('/admin-login', [AdminAuthController::class, 'show'])->name('admin.login');
Route::post('/admin-login', [AdminAuthController::class, 'authenticate'])->name('admin.authenticate');

Route::post('/admin-logout', [AdminAuthController::class, 'logout'])->name('admin-logout')->middleware('auth:admin'); */

Route::get('/admin-dashboard', [AdminDashboardController::class, 'index'])->name('admin-dashboard')->middleware('auth:admin');

Route::get('/admin-profiles', [AdminProfileController::class, 'edit'])->name('admin-profiles.edit')->middleware('auth:admin');
Route::put('/admin-profiles/update', [AdminProfileController::class, 'update'])->name('admin-profiles.update')->middleware('auth:admin');


