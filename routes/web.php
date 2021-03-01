<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\StatusController;

Route::resource('statuses',StatusController::class);
Route::post('statuses/{status}/likes',[LikeController::class,'store'])->name('statuses.like.store')->middleware('auth');
Route::delete('statuses/{status}/likes',[LikeController::class,'destroy'])->name('statuses.like.destroy')->middleware('auth');

Route::resource('likes',LikeController::class);


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::view('/', 'welcome')->name('start');