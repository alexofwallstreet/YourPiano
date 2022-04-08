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
    Route::post('logout', [AuthController::class, 'logout']);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/songs', [SongController::class, 'index']);
Route::get('/songs/{song}', [SongController::class, 'show']);
Route::get('/songs/{song}/midi', [SongController::class, 'midi']);

Route::post('/songs', [SongController::class, 'store']);
Route::put('/songs/{song}', [SongController::class, 'update']);
Route::delete('/songs/{song}', [SongController::class, 'destroy']);

Route::put('users/{user}/update-photo', [UserController::class, 'updatePhoto']);

Route::post('songs/{song}/like', [\App\Http\Controllers\UserSongLikeController::class, 'likeSong']);
Route::post('songs/{song}/dislike', [\App\Http\Controllers\UserSongLikeController::class, 'dislikeSong']);

Route::get('/test', function () {
    var_dump(file_exists(storage_path('app/public/user_profile_photos/default.jpg')));
});
