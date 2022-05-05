<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

class PostCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param Request $request
     * @return Collection
     */
    public function toArray($request)
    {
        return
            $this->collection->map(function ($item) {
                return [
                    'id' => $item->id,
                    'title' => $item->title,
                    'user_phone' => "+98".substr($item->user()->first()->phone, 1),
                    'description' => $item->description,
                    'cooperation' => $item->cooperation()->first()->title,
                    'pmethod' => $item->pmethod()->first()->title,
                    'workinghours' => $item->workinghours()->first()->title,
                    'working_experience' => $item->workingExperiences()->first()->title,
                    'insurance' => $item->insurance,
                    'remote' => $item->remote,
                    'military_service' => $item->military_service,
                    'view' => $item->view,
                    'status' => $item->status,
                    'created_at' => jdate($item->created_at)->ago(),
                ];
            });
    }
}
