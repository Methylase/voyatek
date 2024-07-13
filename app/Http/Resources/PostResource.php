<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
       // return parent::toArray($request);
       return 
            [
                'id' => $this->id,
                'post_title' => $this->post_title,
                'blog_id' => $this->blog_id,
                'post_content' => $this->post_content,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,                
            ];
    
    }
}
