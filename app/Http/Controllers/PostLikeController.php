<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Post;

class PostLikeController extends Controller
{
    /**
     * like a comment.
     */
    public function like(Request $request, Post $post)
    {
        $post->likes()->attach(auth->id());
        return response()->json(['message'=> 'Post liked is successful']); 
    }

}
