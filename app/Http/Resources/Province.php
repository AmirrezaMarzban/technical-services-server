<?php

namespace App\Http\Resources;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Province extends JsonResource
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
            'name' => $this->name,
            'cities' => new CityCollection($this->cities)
        ]];
    }
}
