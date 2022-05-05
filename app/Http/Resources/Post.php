<?php

namespace App\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Post extends JsonResource
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
            'user_phone' => "+98".substr($this->user()->first()->phone, 1),
            'category' => $this->category->title,
            'description' => $this->description,
            'cooperation' => $this->cooperation()->first()->title,
            'pmethod' => $this->pmethod()->first()->title,
            'workinghours' => $this->workinghours()->first()->title,
            'working_experience' => $this->workingExperiences()->first()->title,
            'insurance' => $this->insurance == 1 ? "دارد" : "ندارد",
            'remote' => $this->remote == 1 ? "دارد" : "ندارد",
            'military_service' => $this->military_service == 1 ? "دارد" : "فرقی ندارد",
            'view' => $this->view,
            'status' => $this->status,
            'location' => $this->p_c,
            'created_at' => jdate($this->created_at)->ago(),
        ]];
    }
}
