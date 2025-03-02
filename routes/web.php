<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('User/Dashboard');
})->name('user.dashboard');

Route::get('/news/entertainment/games', function () {
    return Inertia::render('User/Entertainment/Games');
})->name('games');

Route::prefix('admin')->name('admin.')->group(function (){
    Route::get('/dashboard', function () {
        return Inertia::render('Admin/Dashboard');
    })->name('dashboard');
    Route::resource('category', CategoryController::class);
    Route::get('category/{category}/delete', [CategoryController::class, 'delete'])->name('category.delete');
    Route::resource('user', UserController::class);
    Route::get('user/{user}/delete', [UserController::class, 'delete'])->name('user.delete');
    Route::resource('tag', TagController::class);
    Route::get('tag/{tag}/delete', [TagController::class, 'delete'])->name('tag.delete');
    Route::get('/user/admin', [UserController::class, 'showAdmin'])->name('user.admin');
    Route::get('/user/reader', [UserController::class, 'showReader'])->name('user.reader');
    Route::get('/user/author', [UserController::class, 'showAuthor'])->name('user.author');
});
