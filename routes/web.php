<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CommentLikesController;



Route::resource('statuses',StatusController::class);

/** STATUSES LIKES ROUTES */
Route::post('statuses/{status}/likes',[LikeController::class,'store'])->name('statuses.like.store')->middleware('auth');
Route::delete('statuses/{status}/likes',[LikeController::class,'destroy'])->name('statuses.like.destroy')->middleware('auth');


/** STATUSES COMMENTS ROUTES */
Route::post('statuses/{status}/comments',[CommentController::class,'store'])->name('statuses.comments.store')->middleware('auth');


/** COMMENTS LIKES ROUTES */
Route::post('comments/{comment}/likes',[CommentLikesController::class,'store'])->name('comments.likes.store')->middleware('auth');
Route::delete('comments/{comment}/likes',[CommentLikesController::class,'destroy'])->name('comments.likes.destroy')->middleware('auth');


/** USERS ROUTES */
Route::get('/@{user}',[UserController::class,'show'])->name('users.show');



Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::view('/', 'welcome')->name('start');

Auth::routes();



