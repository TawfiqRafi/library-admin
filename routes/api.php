<?php

use App\Http\Controllers\API\BookController;
use App\Http\Controllers\API\LibraryController;
use App\Http\Controllers\API\UserLoginController;
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
Route::group(['namespace' => 'api'], function () {
    Route::post('/user/login', [UserLoginController::class, 'login']);
    Route::post('/user/register', [UserLoginController::class, 'register']);

    Route::middleware(['auth:api'])->group(function () {
        Route::post('/user/update', [UserLoginController::class, 'updateProfile']);
    });
});
