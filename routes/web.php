<?php

use App\Http\Controllers\AuthenController;
use App\Http\Controllers\admin\BookController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\Client\HomeController;
use Illuminate\Support\Facades\Route;

Route::prefix('/')->as('client.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
});

Route::get('/login', [AuthenController::class, 'login'])->name('auth.login');
Route::post('/login', [AuthenController::class, 'postLogin']);
Route::get('/register', [AuthenController::class, 'register'])->name('auth.register');
Route::post('/register', [AuthenController::class, 'postRegister']);
Route::post('/logout', [AuthenController::class, 'logout'])->name('auth.logout');

Route::prefix('admin')->as('admin.')->middleware('check.admin')->group(function () {
    //dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    //User
    Route::resource('users', UserController::class)->names('users');  
    Route::get('/list-member', [UserController::class, 'listMember'])->name('users.listMember');
    Route::get('{id}/detail', [UserController::class, 'detailMember'])->name('users.detailMember');
    // Role
    Route::prefix('roles')->as('roles.')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('index');
        Route::get('create', [RoleController::class, 'create'])->name('create');
        Route::post('store', [RoleController::class, 'store'])->name('store');
        Route::get('{id}/edit', [RoleController::class, 'edit'])->name('edit');
        Route::patch('{id}/update', [RoleController::class, 'update'])->name('update');
        Route::delete('{id}', [RoleController::class, 'destroy'])->name('destroy');
    });
    //Book
    Route::resource('books', BookController::class)->names('books');
    Route::get('books-archive', [BookController::class, 'listBookArchive'])->name('books.archive');
    Route::post('books/{id}/restore', [BookController::class, 'restore'])->name('books.restore');
    Route::delete('books/{id}/force-delete', [BookController::class, 'forceDelete'])->name('books.forceDelete');
    //Category
    Route::resource('categories', CategoryController::class)->names('categories');
    Route::get('categories-archive', [CategoryController::class, 'listCategoryArchive'])->name('categories.archive');
    Route::post('categories/{id}/restore', [CategoryController::class, 'restore'])->name('categories.restore');
    Route::delete('categories/{id}/force-delete', [CategoryController::class, 'forceDelete'])->name('categories.forceDelete');
});
