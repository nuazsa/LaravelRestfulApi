<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomHttpResponseException;
use App\Helpers\ResponseHelper;
use App\Http\Requests\UserLoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function login(UserLoginRequest $request): UserResource
    {
        if ($request->hasHeader('Authorization')) {
            throw new CustomHttpResponseException('Authorization header is not allowed for this request', 403);
        }

        $data = $request->validated();

        $user = User::where('username', $data['username'])->first();
        
        if (!$user || !password_verify($data['password'], $user->password)) {
            throw new CustomHttpResponseException('Username or password is incorrect', 400);
        }
        
        $user->token = Str::uuid()->toString();
        $user->save();

        return new UserResource($user);
    }

    public function logout(Request $request): JsonResponse
    {
        $user = Auth::user();

        $user->update(['token' => null]);

        return ResponseHelper::success('Successfully logged out', null, 200);
    }
}
