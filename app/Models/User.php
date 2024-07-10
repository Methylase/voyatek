<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class User extends Authenticatable
{
    use Notifiable;
    public function likesPosts(){
        return $this->belongToMany(Post::class, 'post_likes', 'user_id', 'post_id');
    }

    
}
