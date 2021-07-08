<?php

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

Route::get('/admin/login', 'Auth\LoginController@sendLoginForm')->name('admin.login.get');
Route::post('/admin/login', 'Auth\LoginController@login')->name('admin.login');

Route::middleware(['auth:admin'])->prefix('admin')->group(function () {

    Route::post('logout', 'Auth\LoginController@logout')->name('admin.logout');

    Route::get('/', 'DashboardController@index')->name('admin.home');

    Route::resource('post', 'PostController');

    Route::resource('user', 'UserController');
    Route::resource('country', 'CountryController');
    Route::resource('category', 'CategoryController');

    Route::resource('media', 'MediaController')->parameter('media', 'media');

    Route::resource('comment', 'CommentController');

    Route::resource('reply', 'ReplyController');

    Route::resource('group', 'GroupController');

    Route::resource('group-user', 'GroupUserController');

    Route::resource('message', 'MessageController');
    Route::get('chat', 'ChatController@index')->name('chat.index');

    // user and models for the chat app
    Route::get('/users', 'Chat\ChatController@users');


    // family blog photos
    Route::resource('family', 'FamilyBlogController');

    // ads
    Route::resource('ads', 'AdController');

    // activities
    Route::resource('activity', 'ActivityController');
});
