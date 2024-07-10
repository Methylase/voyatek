<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Post;
use App\Models\Comment;

class PostCommentController extends Controller
{
    /**
     * comment on a post
     */
    public function store(Request $request, Blog $blog)
    {

        $request->validate([
            'comment' =>'required|string',
        ]);

        $comment= $post->comments()->create([
            'comment'=>$request->input('comment'),
            'user_id' => auth()->id(),
        ]);
        return response()->json([$comment, Response::HTTP_CREATED]);   
    }
}
