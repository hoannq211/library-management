<?php

use App\Http\Controllers\API\AuthenController;
use App\Http\Controllers\API\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::post('login', [AuthenController::class, 'postLogin']);
Route::post('register', [AuthenController::class, 'register']);
Route::post('logout', [AuthenController::class, 'logout'])->middleware('auth:sanctum');
// Books API Routes
Route::group(['middleware' => 'auth:sanctum'], function(){
    Route::prefix('v1')->group(function () {
        Route::apiResource('books', BookController::class);
    });
});