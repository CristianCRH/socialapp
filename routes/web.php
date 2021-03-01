<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\StatusController;

Route::resource('statuses',StatusController::class);

/** STATUSES LIKES ROUTES */
Route::post('statuses/{status}/likes',[LikeController::class,'store'])->name('statuses.like.store')->middleware('auth');
Route::delete('statuses/{status}/likes',[LikeController::class,'destroy'])->name('statuses.like.destroy')->middleware('auth');


/** STATUSES COMMENTS ROUTES */
Route::post('statuses/{status}/comments',[CommentController::class,'store'])->name('statuses.comments.store')->middleware('auth');




//Route::resource('likes',LikeController::class);

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::view('/', 'welcome')->name('start');

Auth::routes();