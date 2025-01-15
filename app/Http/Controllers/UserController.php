<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function login(UserLoginRequest $request): UserResource
    {
        $data = $request->validated();

        $user = User::where('username', $data['username'])->first();
        
        if (!$user || !password_verify($data['password'], $user->password)) {
            throw new HttpResponseException(response([
                'status' => 'error',
                'message' => 'Username or password is incorrect',
            ], 401));
        }
        
        $user->token = Str::uuid()->toString();
        $user->save();

        return new UserResource($user);
    }
}
