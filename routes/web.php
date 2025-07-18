<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group (function () {
    Route::get('/dashboard', function () {
        return view('dashboard'); 
    })->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->prefix('category')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('categories');
    Route::put('/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::patch('/{id}/update', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/{id}/destroy', [CategoryController::class, 'destroy'])->name('categories.destroy');
});

require __DIR__.'/auth.php';
