<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LonginWithGoogleController;

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
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('auth/google', [LonginWithGoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [LonginWithGoogleController::class, 'handleGoogleCallback']);

Route::group(['middleware' => ['auth', 'level:admin']], function (){
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
});

Route::group(['middleware' => ['auth', 'level:operator']], function (){

});

Route::group(['middleware' => ['auth', 'level:owner']], function (){
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::group(['middleware' => ['auth', 'level:pelanggan']], function (){

});

