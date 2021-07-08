<?php

use App\Http\Controllers\Chat\ChatController;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// those routes are for trying the app in home
// they are meant to be deleted;

Route::get('/users', [ChatController::class, 'users']);
Route::get('/user/{user}/get-messages', [ChatController::class, 'getUserMessages']);
Route::post('/user/{user}/send-message', [ChatController::class, 'sendMessage']);
Route::get('/auth-user', function () {
    return auth()->user();
});
