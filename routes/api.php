<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Todo:
|--------------------------------------------------------------------------
| 1. image Uplode
| 2. loading
| 3. select2
| 4. model
| 5.
|
*/
Route::post('/login','PassportController@login');
Route::post('/register','PassportController@register');


Route::middleware('auth:api')->group(function () {
    Route::get('/user', 'PassportController@details');
    Route::get('/get-unread-notifications', 'PassportController@unreadNotification');
    Route::get('/get-all-notifications', 'PassportController@allNotification');

    Route::apiResource('/posts','PostController');
    Route::get('/posts/search/{search}','PostController@searchPosts');
    Route::post('/posts/comment/create','CommentController@store');

    Route::get('/category/{slug}/posts','PostController@categoryPosts');
    Route::apiResource('/categories','CategoryController');

    Route::prefix('/admin')->middleware('isAdmin')->group(function () {
        Route::get('/posts','AdminController@getPosts');
        Route::post('/post','AdminController@addPost');
        Route::post('/post/edit','AdminController@editPost');
        Route::delete('/post/{id}','AdminController@deletePost');
        Route::get('/categories','AdminController@getCategories');

    });
});


