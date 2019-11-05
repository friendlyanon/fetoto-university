<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserImagesController;

Auth::routes(['reset' => false]);

Route::permanentRedirect('/home', '/');

Route::get('/', as_route(HomeController::class, 'index'))->name('home');

Route::resource('image', as_route(ImageController::class))
    ->except(['edit', 'update']);

Route::resource('user', as_route(UserController::class))
    ->only(['show']);

Route::get('/user/{id}/images', as_route(UserImagesController::class, 'index'))
    ->name('user.images.index');

AssetController::routes();
