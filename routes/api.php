<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return response()->json([
        'message' => 'API is working'
    ]);
});

Route::post('/account/create', [App\Http\Controllers\AccountController::class, 'create']);

Route::middleware('auth:sanctum')->group(function () {
    //Timer
    Route::post('/time_log/create', [App\Http\Controllers\TimeLogController::class, 'create']);
    Route::get('/time_log', [App\Http\Controllers\TimeLogController::class, 'read']);
});