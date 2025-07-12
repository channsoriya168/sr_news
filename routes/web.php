<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use Inertia\Inertia;

use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return Inertia::render('User/Dashboard', []);
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('dashboard')->group(function () {
    Route::get('/', function () {
        return Inertia::render('Admin/Dashboard', []);
    })->name('dashboard');
    Route::resource('categories', CategoryController::class, [
        'names' => [
            'index' => 'admin.category.index',
            'create' => 'admin.category.create',
            'store' => 'admin.category.store',
            'show' => 'admin.category.show',
            'edit' => 'admin.category.edit',
            'update' => 'admin.category.update',
            'destroy' => 'admin.category.destroy',
        ]
    ]);
    Route::get('categories/{category}/delete', [CategoryController::class, 'delete'])->name('admin.category.delete');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
