<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'image' => $this->image,
            'name' => $this->name,
            'phone' => $this->phone,
            'division' => [
                'id' => $this->division->id,
                'name' => $this->division->name,
            ],
            'position' => $this->position,
        ];
    }
}