<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request):array
    {
       // return parent::toArray($request);
       return [ 
        'id' => $this->id,
        'blog_title' => $this->blog_title,
        'blog_content' => $this->blog_content,
        'image_url' => $this->image_url,
        'created_at' => $this->created_at,
        'updated_at' => $thid->updated_at,
       ];
    }
}
