<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdministrationController;

/**
 * APP ROUTES
 */
//Route::get('/', function () { return view('app.app'); } )->name('homepage');


/**
 * DASHBOARD ROUTES
 */
Route::prefix('dashboard')->name('dashboard.')->middleware('auth')->group( function() {
    Route::get('', [DashboardController::class, 'index'])->name('index');
});


/**
 * ADMIN ROUTES
 */
Route::get('/admin', [AdministrationController::class, 'index'])->middleware('auth', 'is_admin');


/**
 * AUTH ROUTES
 */
/* Route::get('login', [AuthController::class, 'loginIndex'])->name('login-user');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('registration', [AuthController::class, 'registrationIndex'])->name('registration-user');
Route::post('registration', [AuthController::class, 'registration'])->name('registration');
Route::get('signout', [AuthController::class, 'signout'])->name('signout'); */


/**
 * GOOGLE AUTH ROUTES
 */
Route::prefix('google')->name('google.')->group( function() {
    Route::get('login', [GoogleController::class, 'login'])->name('login');
    Route::any('callback', [GoogleController::class, 'callback'])->name('callback');
});


Route::get('/{any?}', function() {
    return view('app.app');
})->where('any', '.*');