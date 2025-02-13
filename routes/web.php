<?php

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
});
Route::get('/admin/author', function () {
    return Inertia::render('Admin/Author/index');
})->name('author.index');
