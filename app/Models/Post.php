<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Blog;
use App\Models\Comment;
use App\Models\Like;
use App\Models\User;


class Post extends Model
{
    use HasFactory;
    protected $fillable = ['post_title', 'post_content','blog_id'];
     
    public function blog(){
        return $this->belongTo(Blog::class);
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

}
