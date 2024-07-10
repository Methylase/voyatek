<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Blog;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * show all posts under a blog.
     */
    public function index(Blog $blog)
    {
        $posts= $blog->posts;
        return response()->json([$posts]); 
    }


    /**
     * Create a post for a blog.
     */
    public function store(Request $request, Blog $blog)
    {

        $request->validate([
            'post_title' =>'required|string',
            'post_description' =>'required|string'
        ]);

        $post= $blog->posts()->create($request->all());
        return response()->json([$post, Response::HTTP_CREATED]);   
    }

    /**
     * show a particular post under a blog
     */
    public function show(Blog $blog, Post $post)
    {
        return response()->json([$post]);     
    }

    /**
     * update a particular post on under a blog
     */
    public function update(Request $request, Blog $blog, Post $post)
    {
        $request->validate([
            'post_title' =>'required|string',
            'post_description' =>'required|string'
        ]);

        $post->update($request->all());
        return response()->json([$post]);
    }

    /**
     * delete a particular post under a blog
     */
    public function destroy(Blog $blog, Post $post)
    {

        $post->delete();
        return response()->json([null, HTTP_NO_CONTENT]);    
    }
}
