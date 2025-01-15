<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DivisionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $mappedDivisions = $this->resource->map(function ($division) {
            return [
                'id' => $division->id,
                'name' => $division->name,
            ];
        });

        return [
            'status' => 'success',
            'message' => 'Data retrieved successfully.',
            'data' => [
                'divisions' => $mappedDivisions,
            ],
            'pagination' => [
                'current_page' => $this->currentPage(),
                'per_page' => $this->perPage(),
                'total' => $this->total(),
                'last_page' => $this->lastPage(),
            ],
        ];
    }
}
