<?php

use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\Chat\ChatController;
use App\Http\Controllers\API\Chat\ChatMediaController;
use App\Http\Controllers\API\CountryController;
use App\Http\Controllers\API\GroupController;
use App\Http\Controllers\API\MediaCollectionController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\ReplyController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\SearchController;
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

Route::post('login', [LoginController::class, 'login']);
Route::post('register', [LoginController::class, 'register']);
Route::get('countries', [CountryController::class, 'index']);
Route::post('social-login', [LoginController::class, 'social']);

Route::middleware('auth:api')->group(function () {

    Route::get('family-blogs', 'API\FamilyBlogController@getBlogs');
    Route::get('search/{key}', [SearchController::class, 'search']);
    Route::prefix('users')->group(function () {
        Route::get('/users', [UserController::class, 'users']);
        Route::get('/get-followers', [UserController::class, 'followers']);
        Route::get('/get-follows', [UserController::class, 'follows']);
        Route::get('/user-profile', [UserController::class, 'profile']);
        Route::get('/get-profile/{user}', [UserController::class, 'getProfile']);
        Route::post('/follow/{user}', [UserController::class, 'follow']);
        Route::get('/following', [UserController::class, 'following']);
        Route::post('/unfollow/{user}', [UserController::class, 'unfollow']);
        Route::post('/update-profile', [UserController::class, 'updateProfile']);
        Route::get('/user-comment-activity', [UserController::class, 'getUserCommentActivity']);
        Route::get('/user-like-activity', [UserController::class, 'getUserLikeActivity']);
        Route::get('/user-follow-activity', [UserController::class, 'getUserFollowActivity']);
        Route::post('/accept-followers/{follower}/{flag}', [UserController::class, 'acceptFollower']);
    });

    Route::prefix('category')->group(function () {
        Route::get('/all-category', [CategoryController::class, 'allCats']);
        Route::get('/paid-cats', [CategoryController::class, 'paidCats']);
        Route::get('/unpaid-cats', [CategoryController::class, 'unpaidCats']);
        Route::get('/show-cat/{id}', 'API\CategoryController@show');
    });

    Route::prefix('chat')->group(function () {
        Route::get('/user/{user}/get-messages', [ChatController::class, 'getUserMessages']);
        Route::post('/user/{user}/send-message', [ChatController::class, 'sendMessage']);
    });

    Route::prefix('chat-media')->group(function () {
        Route::post('/', [ChatMediaController::class, 'store']);
    });

    Route::prefix('media')->group(function () {
        Route::apiResource('media', 'API\MediaCollectionController')->parameter('media', 'media');
        Route::get('/saved-media', [MediaCollectionController::class, 'savedMedia']);
        Route::get('/memory-media', [MediaCollectionController::class, 'memoryMedia']);
        Route::post('/get-media-comments', [MediaCollectionController::class, 'mediaComments']);
        Route::post('/like-media-collection/{media}', [MediaCollectionController::class, 'likeMedia']);
        Route::delete('/remove-media-like/{media}', [MediaCollectionController::class, 'removeLike']);
        Route::post('/saved-media/{media}', [MediaCollectionController::class, 'saveMedia']);
        Route::delete('/remove-saved-media/{media}', [MediaCollectionController::class, 'unsaveMedia']);
        Route::post('/dislike-media-collection/{media}/{flag}', [MediaCollectionController::class, 'dislikeMedia']);
        Route::post('/add-remove-memory-media/{media}/{flag}', [MediaCollectionController::class, 'memoryUnmemoryMedia']);
    });

    Route::prefix('comments')->group(function () {
        Route::apiResource('comment', 'API\CommentController');
        Route::post('/like-comment-collection/{comment}', 'API\CommentController@likeMedia');
        Route::delete('/remove-comment-like/{comment}', 'API\CommentController@removeLike');
        Route::delete('/remove-comment-dislike/{comment}', 'API\CommentController@removedisLike');
        Route::post('/dislike-comment-collection/{comment}/{flag}', 'API\CommentController@dislikeMedia');
        Route::get('/{comment}/get-replies', 'API\CommentController@getReplies');
    });

    Route::prefix('replies')->group(function () {
        Route::apiResource('reply', 'API\ReplyController');
        Route::get('/get-reply-replies/{reply}', [ReplyController::class, 'getReplies']);
    });


    Route::prefix('ads')->group(function () {
        Route::get('ads', 'API\AdController@index');
    });

    Route::prefix('groups')->group(function () {
        Route::apiResource('group', 'API\GroupController');
        Route::post('/{group}/add-users', [GroupController::class, 'addUsers']);
        Route::post('/{group}/remove-users', [GroupController::class, 'removeUsers']);
    });

    Route::apiResource('post', 'API\PostController');
    Route::prefix('post')->group(function () {
        Route::get('/saved-post', [PostController::class, 'savedPost']);
        Route::get('/memory-post', [PostController::class, 'getMemoryPosts']);
        Route::get('/get-post-comments/{post}', [PostController::class, 'postComments']);
        Route::post('/like-post/{post}', [PostController::class, 'likePost']);
        Route::delete('/remove-post-like/{post}', [PostController::class, 'removeLike']);
        Route::post('/save-post/{post}', [PostController::class, 'savePost']);
        Route::delete('/remove-saved-post/{post}', [PostController::class, 'unSavePost']);
        Route::post('/dislike-post/{post}', [PostController::class, 'disLikePost']);
        Route::post('/remove-post-dislike/{post}', [PostController::class, 'removeDislike']);
        Route::post('/add-memory-post/{post}', [PostController::class, 'addMemoryPost']);
        Route::post('/remove-memory-post/{post}', [PostController::class, 'removeMemoryPost']);
    });




});


