<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::middleware('auth:sanctum')->group( function () {
    Route::POST('get_users','Api\LoginController@get_users')->name('get_users');
    //blogs
    Route::POST('get_blogs','Api\BlogController@get_blogs')->name('get_blogs');
    Route::POST('create_blog','Api\BlogController@create_blog')->name('create_blog');
    Route::POST('blog_like','Api\BlogController@blog_like')->name('blog_like');

});
Route::POST('login','Api\LoginController@login')->name('login');
