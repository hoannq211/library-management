<?php

use App\Http\Controllers\API\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Books API Routes
Route::prefix('v1')->group(function () {
    Route::apiResource('books', BookController::class);
});