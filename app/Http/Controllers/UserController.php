<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomHttpResponseException;
use App\Http\Requests\UserLoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function login(UserLoginRequest $request): UserResource
    {
        $data = $request->validated();

        $user = User::where('username', $data['username'])->first();
        
        if (!$user || !password_verify($data['password'], $user->password)) {
            throw new CustomHttpResponseException('Username or password is incorrect', 400);
        }
        
        $user->token = Str::uuid()->toString();
        $user->save();

        return new UserResource($user);
    }

    public function logout(Request $request)
    {
        try {
            $user = Auth::user();
    
            $user->update(['token' => null]);
    
            return response()->json([
                'status' => 'success',
                'message' => 'Successfully logged out',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to log out: ' . $e->getMessage(),
            ], 500);
        }
    }
}
