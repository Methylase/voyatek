<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Suport\Facades\Auth;
use App\Http\Resources\CommentResource;

class PostCommentController extends Controller
{
    /**
     * comment on a post
     */
    public function store(Request $request, Post $post)
    {

        $comment= $post->comments()->create([
            'comment'=>$request->input('comment'),
            'user_id' => $request->auth_user,
        ]);
        
        return response()->json([
            'data'=> new CommentResource($comment),
            'status'=>'success',
            'code'=>200
        ],200); 
    }
}
