<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', 'UserController@login');
Route::post('register', 'UserController@register');

Route::middleware('auth:api')->group(function () {
    // Route::get('user', 'UserController@details');
    //post data profile
    Route::post('post', 'PostController@postdata');
    Route::get('displaypost', 'PostController@display_user_post');
    Route::get('displaypost/{id}', 'PostController@show_user_post');
    Route::put('displaypost/update/{id}', 'PostController@update');
    Route::delete('displaypost/delete/{id}', 'PostController@destroy');
		Route::post('test', 'PostController@test');
    //page feed
    Route::get('pages', 'PageController@display_data');
    Route::put('pages/update/{id}', 'PagexController@update');
    Route::delete('pages/detele/{id}', 'PageController@destroy');
    // Route::resource('pages', 'PageController');
    //search category
    Route::get('category', 'CategoryController@display_categories');
    Route::get('category/{id}', 'CategoryController@show_categories');
    // search type
    Route::resource ('type', 'TypeController');
});
