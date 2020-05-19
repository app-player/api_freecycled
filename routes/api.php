<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', 'UserController@login');
Route::post('register', 'UserController@register');

Route::middleware('auth:api')->group(function () {
    Route::get('user', 'UserController@details');

    Route::resource('posts', 'PostController');
    Route::resource('pages', 'PageController');
    Route::resource('category', 'CategoryController');
    Route::resource('type', 'TypeController');
});