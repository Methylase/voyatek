<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Blog;
use App\Http\Resources\BlogResource;
use Validator;
class BlogController extends Controller
{
    /**
     * show all blogs.
     */
    public function index()
    {
        $blog= Blog::all();
        return response()->json([$blog]); 
    }


    /**
     * Create blog.
     */
    public function store(Request $request)
    {

        $request->validate([
            'blog_image' =>'required|mimes:jpeg,png,jpg,gif|max:2048',
            'blog_title' =>'required|string',
            'blog_description' =>'required|string',
        ]);

        $image_path = $request->file('blog_image')->store('blogs','public');
        $image_url = Storage::url($image_path);
        $blog= new Blog;
        $blog->blog_title = $request->input('blog_title');
        $blog->blog_content = $request->input('blog_description');
        $blog->image_url = $image_url;
        $blog->save();
        return response()->json([$blog, Response::HTTP_CREATED]);   
    }

    
    /**
     * show a particular blog
     */
    public function show(string $id)
    {
        $blog= Blog::findOrFail($id);
        return response()->json([$blog]);     
    }

    /**
     * update a particular blog
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
             'blog_image' =>'required|mimes:jpeg,png,jpg,gif|max:2048',
            'blog_title' =>'required|string',
            'blog_description' =>'required|string',
        ]);

        $image_path = $request->file('blog_image')->store('blog','public');
        $image_url = Storage::url($image_path);

        $blog= Blog::findOrFail($id);

        $blog->blog_title = $request->input('blog_title');
        $blog->blog_content = $request->input('blog_description');
        $blog->image_url = $image_url;
        $blog->save();
        return response()->json([$blog]);
    }

    /**
     * delete a particular blog
     */
    public function destroy(string $id)
    {
        $blog= Blog::findOrFail($id);
        $blog->delete();
        return response()->json([null, HTTP_NO_CONTENT]);    
    }
}
