<?php

use App\Http\Controllers\AuthenController;
use App\Http\Controllers\admin\BookController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\Client\HomeController;
use Illuminate\Support\Facades\Route;

Route::prefix('client')->as('client.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');
});

Route::get('/login', [AuthenController::class, 'login'])->name('auth.login');
Route::post('/login', [AuthenController::class, 'postLogin']);
Route::get('/register', [AuthenController::class, 'register'])->name('auth.register');
Route::post('/register', [AuthenController::class, 'postRegister']);
Route::get('/logout', [AuthenController::class, 'logout'])->name('auth.logout');

Route::prefix('admin')->as('admin.')->middleware('check.admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class)->names('users');
    Route::resource('books', BookController::class)->names('books');
    Route::get('books-archive', [BookController::class, 'listBookArchive'])->name('books.archive');
    Route::post('books/{id}/restore', [BookController::class, 'restore'])->name('books.restore');
    Route::delete('books/{id}/force-delete', [BookController::class, 'forceDelete'])->name('books.forceDelete');
    
    Route::resource('categories', CategoryController::class)->names('categories');
});
