<?php
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostLikeController;

Route::prefix('api')->group(["middleware"=>"token.auth"], function(){
     
    Route::resouces('blogs', BlogController::class);
    Route::resouces('blogs.posts', PostController::class)->shallow();
    Route::post('/post/{post}/like', [PostLikeController::class,'like']);
    Route::post('/post/{post}/comments', [PostCommentController::class, 'store']);
});