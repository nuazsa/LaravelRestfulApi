<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'status' => 'success',
            'message' => 'Login success',
            'data' => [
                'token' => $this->token,
                'admin' => [
                    'id' => $this->id,
                    'name' => $this->name,
                    'username' => $this->username,
                    'phone' => $this->phone,
                    'email' => $this->email,
                ],
            ]
        ];
    }
}
