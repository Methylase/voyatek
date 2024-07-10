<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Blog;
use App\Models\Comment;
use App\Models\User;


class Post extends Model
{
    use HasFactory;
    protected $fillable = ['post_title', 'post_content'];
     
    public function blog(){
        return $this->belongTo(Blog::class);
    }

    public function likes(){
        return $this->belongToMany(User::class, 'post_likes', 'post_id', 'user_id');
    }

    public function comments(){
        return $this->belongToMany(Comment::class);
    }

}
