<?php

namespace App\Http\Resources;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Category extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [[
            'id' => $this->id,
            'title' => $this->title,
            'icon' => $this->icon,
            'background' => $this->background,
            'count' => $this->posts->count(),
            'posts' => new PostCollection($this->posts->where('status', 1)->where('p_c', auth()->user()->p_c()))
        ]];
    }
}
