<?php

use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return redirect('login');
});

Auth::routes();

Route::get('authentication-failed', function () {
    $errors = [];
    array_push($errors, ['code' => 'auth-001', 'message' => 'Unauthenticated.']);
    return response()->json([
        'errors' => $errors,
    ], 401);
})->name('authentication-failed');

Route::get('register', function () {
    return redirect('login');
});

Route::get('home', function () {
    return redirect('admin');
});

Route::get('admin', function () {
    return redirect('admin');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function ($router) {
    $router->get('/', [DashboardController::class, 'index'])->name('dashboard');
});
