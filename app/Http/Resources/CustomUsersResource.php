<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomUsersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $array = [
            'id' => $this->resource->id,
            'user' => $this->resource->user,
            'firstName' => $this->resource->firstName,
            'secondName' => $this->resource->secondName,
            'lastName' => $this->resource->lastName,
            'secondLastname' =>$this->resource->secondLastname ,
        ];
        return parent::toArray($request);
    }
}
