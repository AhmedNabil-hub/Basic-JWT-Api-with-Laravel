<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Controller;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::apiResource('posts', PostController::class);


Route::middleware('jwt')->group(function () {
	Route::get('/posts', [PostController::class, 'index']);
	Route::get('/posts/{post}', [PostController::class, 'show']);
	Route::post('/posts',  [PostController::class, 'store']);
	Route::post('/posts/{post}',  [PostController::class, 'update']);
	Route::delete('/posts/{post}', [PostController::class, 'destroy']);
});

Route::prefix('auth')->middleware('api')->group(function () {
	Route::post('/login', [LoginController::class, 'login']);
	Route::post('/register', [RegisterController::class, 'register']);
	Route::post('/logout', [Controller::class, 'logout']);
	Route::post('/refresh', [Controller::class, 'refresh']);
	Route::get('/user-profile', [Controller::class, 'userProfile']);
});
