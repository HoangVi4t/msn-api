<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('/register', [\App\Http\Controllers\API\AuthController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\API\AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {

    //USER
    Route::get('users/{id}', [\App\Http\Controllers\API\UserController::class, 'show']);
    Route::put('users/{id}', [\App\Http\Controllers\API\UserController::class, 'update']);

    //YOUTUBE
    Route::get('youtube/{user_id}', [\App\Http\Controllers\API\YoutubeController::class, 'show']);
    Route::post('youtube', [\App\Http\Controllers\API\YoutubeController::class, 'store']);
    Route::delete('youtube/{id}', [\App\Http\Controllers\API\YoutubeController::class, 'destroy']);

    //SONG
    Route::post('songs', [\App\Http\Controllers\API\SongController::class, 'store']);
    Route::delete('songs/{id}/{user_id}', [\App\Http\Controllers\API\SongController::class, 'destroy']);
    Route::get('user/{user_id}/songs', [\App\Http\Controllers\API\SongByUserController::class, 'index']);

    //POST
    Route::get('posts', [\App\Http\Controllers\API\PostController::class, 'index']);
    Route::get('posts/{id}', [\App\Http\Controllers\API\PostController::class, 'show']);
    Route::post('posts', [\App\Http\Controllers\API\PostController::class, 'store']);
    Route::put('posts/{id}', [\App\Http\Controllers\API\PostController::class, 'update']);
    Route::delete('posts/{id}', [\App\Http\Controllers\API\PostController::class, 'destroy']);

    //POST BY USER
    Route::get('user/{user_id}/posts', [\App\Http\Controllers\API\PostsByUserController::class, 'show']);


    //LOGOUT
    Route::post('/logout', [\App\Http\Controllers\API\AuthController::class, 'logout']);


    Route::get('inside-mware', function () {
        return response()->json('Success', 200);
    });
});
