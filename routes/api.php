<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SongController;
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
Route::get('/songs/{id}', [SongController::class, 'show']);
Route::get('/songs/{id}/midi', [SongController::class, 'midi']);


Route::get('/test', function () {
  var_dump(file_exists(storage_path('app/public/user_profile_photos/default.jpg')));
});
