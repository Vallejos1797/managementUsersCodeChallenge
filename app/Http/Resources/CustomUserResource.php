<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'email' => $this->email,
            'firstName' => $this->firstName,
            'secondName' => $this->secondName,
            'lastName' => $this->lastName,
            'secondLastName' => $this->secondLastName,
            'department' => [
                'id' => $this->departmentId,
                'name' => $this->whenLoaded('department', function () {
                    return $this->department->name;
                }),
            ],
            'position' => [
                'id' => $this->positionId,
                'name' => $this->whenLoaded('position', function () {
                    return $this->position->name;
                }),
            ],
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
