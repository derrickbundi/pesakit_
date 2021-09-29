<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\apis\usercontroller;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('auth')->group(function() {
    Route::post('/login', [usercontroller::class, 'login']);
    Route::post('/register', [usercontroller::class, 'register']);
    //restrict access to only autheticated users
    Route::middleware('auth:api')->group(function() {
        Route::get('/profile-detail', [usercontroller::class, 'profile_view']);
    });
});
