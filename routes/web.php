<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Petugas\PetugasController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CekRole;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// User routes
Route::middleware(['auth', CekRole::class.':user'])->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard');
});

// Admin routes
Route::middleware(['auth', CekRole::class.':admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});

// Petugas routes
Route::middleware(['auth', CekRole::class.':petugas'])->group(function () {
    Route::get('/petugas/dashboard', [PetugasController::class, 'index'])->name('petugas.dashboard');
});


// View
Route::get('/', function () {
    return view('admin.dashboard', ['title' => 'Dashboard']);
})->name('index');

require __DIR__.'/auth.php';

