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
    
        $like = $post->likes()->firstOrCreate([
            'user_id' => $request->auth_user
        ]);
        
        $post= Post::where('id',$like->post_id)->first(); 
        return response()->json([
            'message'=> $post->post_title.' successfully liked',
            'status'=>'success',
            'code'=>200
        ],200); 
    }

}
