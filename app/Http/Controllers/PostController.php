<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\PostResource;
use App\Models\Blog;
use App\Models\Post;
use Validator;

class PostController extends Controller
{
    /**
     * show all posts under a blog.
     */
    public function index(Blog $blog)
    {
        $posts= $blog->posts;
        return response()->json([
            'data'=> PostResource::collection($posts),
            'status'=>'success',
            'code'=>200
        ],200); 
         
    }


    /**
     * Create a post for a blog.
     */
    public function store(Request $request, Blog $blog){

        $validator = Validator::make($request->all(),[
            'post_title' =>'required|string',
            'post_content' =>'required|string',
        ]);
        if($validator->fails()){
            return response()->json([
                'message' => 'validation failed',
                'errors' => $validator->errors(),
                'code'=>422
            ],422); 
        }else{

            $post= $blog->posts()->create($request->all());
            return response()->json([
                'data'=> new PostResource($post),
                'status'=>'success',
                'code'=>201
            ],201);
        }
    }

    /**
     * show a particular post under a blog
     */
    public function show(Blog $blog, Post $post)
    {
    
        return response()->json([
            'data'=> new PostResource($post),
            'status'=>'success',
            'code'=>200
        ]); 
        
    }

    /**
     * update a particular post on under a blog
     */
    public function update(Request $request, Blog $blog, Post $post)
    {  

        $validator = Validator::make($request->all(),[
            'post_title' =>'required|string',
            'post_content' =>'required|string',
        ]);
        if($validator->fails()){
            return response()->json([
                'message' => 'validation failed',
                'errors' => $validator->errors(),
                'code'=>422
            ],422); 
        }else{
            $post->update($request->all());
            return response()->json([
                'data'=> new PostResource($post),
                'status'=>'success',
                'code'=>200
            ],200); 
        }
        
    }

    /**
     * delete a particular post under a blog
     */
    public function destroy(Blog $blog, Post $post)
    {

        $post->delete();
        return response()->json([
            'status'=>'success',
            'code'=>200,
            'message'=>'Post deleted successfully'
        ],200); 
           

       
    }
}
