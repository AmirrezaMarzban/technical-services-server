<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    protected $token;
    protected $verified;

    public function __construct($resource, $token, $verified)
    {
        $this->token = $token;
        $this->verified = $verified;
        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'data' => [[
                'token' => $this->token,
                'verified' => $this->verified
            ]]
        ];
    }

    public function with($request)
    {
        return [
            'status' => 'success'
        ];
    }
}
