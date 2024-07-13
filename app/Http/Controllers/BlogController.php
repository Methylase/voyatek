<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Blog;
use App\Http\Resources\BlogResource;
use Storage;
use Validator;
class BlogController extends Controller
{
    /**
     * show all blogs.
     */
    public function index()
    {
        $blog= Blog::all();
     
        return response()->json([
            'data'=> BlogResource::collection($blog),
            'status'=>'success',
            'code'=>200
        ],200); 
        

    }


    /**
     * Create blog.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'blog_image' =>'required|mimes:jpeg,png,jpg,gif|max:2048',
            'blog_title' =>'required|string',
            'blog_content' =>'required|string',
        ]);
        if($validator->fails()){
            return response()->json([
                'message' => 'validation failed',
                'errors' => $validator->errors(),
                'code'=>422
            ],422); 
        }else{
            $image_path = $request->file('blog_image')->store('blogs','public');
            $image_url = Storage::url($image_path);
            $blog= new Blog;
            $blog->blog_title = $request->input('blog_title');
            $blog->blog_content = $request->input('blog_content');
            $blog->image_url = $image_url;
            $blog->save();
            return response()->json([
                'data'=> new BlogResource($blog),
                'status'=>'success',
                'code'=>201
            ],201);
        }
 
    }

    
    /**
     * show a particular blog
     */
    public function show($id)
    {

        $blog= Blog::where('id',$id)->first();
        if($blog){
            return response()->json([
                'data'=> new BlogResource($blog),
                'status'=>'success',
                'code'=>200
            ]); 
        }else{
            return response()->json([
                'data'=> [],
                'message'=> 'Blog id '.$id.' is not found',
                'code'=>404
            ],404); 
        }
   
    }

    /**
     * update a particular blog
     */
    public function update(Request $request,$id)
    {

        $blog= Blog::where('id',$id)->first(); 
        
        if($blog){
            $validator = Validator::make($request->all(),[
                'blog_image' =>'required|string',
                'blog_title' =>'required|string',
                'blog_content' =>'required|string',
            ]);
    
            if($validator->fails()){
                return response()->json([
                    'message' => 'validation failed',
                    'errors' => $validator->errors(),
                    'code'=>422
                ],422); 
            }else{    
                $image_url = $request->input('blog_image');
                $blog->blog_title = $request->input('blog_title');
                $blog->blog_content = $request->input('blog_content');
                $blog->image_url = $image_url;
                $blog->save();
    
                return response()->json([
                    'data'=> new BlogResource($blog),
                    'status'=>'success',
                    'code'=>200
                ],200); 
            }
        }else{
            return response()->json([
                'data'=> [],
                'message'=> 'Blog id '.$id.' is not found',
                'code'=>404
            ],404); 
        }        
    }

    /**
     * delete a particular blog
     */
    public function destroy($id)
    {

        $blog= Blog::where('id',$id)->first();
        if($blog){
        $blog->delete();
            return response()->json([
                'status'=>'success',
                'code'=>200,
                'message'=>'Blog deleted successfully'
            ],200); 
        }else{
            return response()->json([
                'data'=> [],
                'message'=> 'Blog id '.$id.' is not found',
                'code'=>404
            ],404);             
        }  
    }
}
