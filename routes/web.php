<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;


Auth::routes();

Route::middleware(['auth'])->group(function () {
	Route::view('/', 'home')->name('home');
	Route::get('/home', fn () => redirect()->route('home'));
	Route::resource('posts', PostController::class);
});
