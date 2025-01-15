<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DivisionController;
use App\Http\Middleware\AuthMiddleware;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/ping', function () {
    return response()->json([
        'message' => 'Pong!',
    ]);
});

Route::post('/login', [UserController::class, 'login']);

Route::middleware(AuthMiddleware::class)->group(function () {
    Route::get('/divisions', [DivisionController::class, 'index']);
});
// Route::get('/divisions', [DivisionController::class, 'index']);