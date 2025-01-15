<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header('Authorization');
        $authenticated = true;

        if (!$token) {
            $authenticated = false;
        } else {
            $user = User::where('token', $token)->first();
            if (!$user) {
                $authenticated = false;
            } else {
                Auth::login($user);
            }
        }

        if (!$authenticated) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
