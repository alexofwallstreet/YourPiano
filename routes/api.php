<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    //auth
    Route::post('logout', [AuthController::class, 'logout']);

    //users
    Route::get('users', [UserController::class, 'index']);
    Route::put('users/{user}/update-password', [UserController::class, 'updatePassword']);
    Route::delete('users/{user}', [UserController::class, 'destroy']);
    Route::delete('users/{user}/results', [UserController::class, 'destroyResults']);
    Route::put('users/{user}', [UserController::class, 'update']);
    Route::get('users/{user}/stats', [UserController::class, 'stats']);

    //songs
    Route::get('/songs/{song}/midi', [SongController::class, 'midi']);

    //rating play
    Route::post('songs/{song}/rating-play', [\App\Http\Controllers\UserSongRatingPlayController::class, 'create']);

    //likes
    Route::post('songs/{song}/like', [\App\Http\Controllers\UserSongLikeController::class, 'likeSong']);
    Route::post('songs/{song}/dislike', [\App\Http\Controllers\UserSongLikeController::class, 'dislikeSong']);
    Route::get('/user-song-likes', [\App\Http\Controllers\UserSongLikeController::class, 'show']);

    Route::middleware('admin')->group(function () {
        //admin stats
        Route::put('/songs/{song}', [SongController::class, 'update']);
        //songs
        Route::post('/songs', [SongController::class, 'store']);
        Route::delete('/songs/{song}', [SongController::class, 'destroy']);
        Route::get('/admin-stats', [UserController::class, 'adminStats']);
    });
});

//auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

//songs
Route::get('/songs', [SongController::class, 'index']);
Route::get('/songs/{song}', [SongController::class, 'show']);