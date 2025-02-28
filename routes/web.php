<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('User/Dashboard');
})->name('dashboard');
Route::get('/admin', function () {
    return Inertia::render('Admin/Dashboard');
})->name('dashboard');
Route::get('/admin/dashboard', function () {
    return Inertia::render('Admin/Dashboard');
})->name('dashboard');
Route::get('/news/entertainment/games', function () {
    return Inertia::render('User/Entertainment/Games');
})->name('games');

Route::prefix('admin')->name('admin.')->group(function (){
    Route::resource('category', CategoryController::class);
    Route::get('category/{category}/delete', [CategoryController::class, 'delete'])->name('category.delete');
    Route::resource('user', UserController::class);
    Route::get('user/{user}/delete', [UserController::class, 'delete'])->name('user.delete');
    Route::get('/admin/author', [UserController::class, 'showAuthor'])->name('author.index');
});
