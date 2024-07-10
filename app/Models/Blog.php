<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = ['blog_title', 'blog_content','image_url'];
     
    public function posts(){
        return $this->hasMany(Post::class);
    }
}
