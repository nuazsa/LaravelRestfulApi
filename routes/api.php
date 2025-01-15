<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DivisionController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/ping', function () {
    return response()->json([
        'message' => 'Pong!',
    ]);
});

Route::post('/login', [UserController::class, 'login']);

Route::get('/divisions', [DivisionController::class, 'index']);