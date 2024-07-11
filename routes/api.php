<?php
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostLikeController;


Route::group(['middleware'=>'token.auth'], function(){
Route::resource('blogs', BlogController::class);
Route::resource('blogs.posts', PostController::class)->shallow();
Route::post('post/{post}/like', [PostLikeController::class, 'like']);
Route::post('post/{post}/comment', [PostCommentController::class, 'comment']);
});