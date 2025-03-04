<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Peminjam\PeminjamController;
use App\Http\Controllers\Admin\Petugas\PetugasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserController;
use App\Http\Middleware\CekRole;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// User Dashboard
Route::middleware(['auth', CekRole::class.':user'])->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard');
});

// Admin Dashboard
Route::middleware(['auth', CekRole::class.':admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    // Users
    // Route::post('/users/create',[AdminController::class,'store'])->name('admin.users.store');
    Route::delete('/users/{user}', [AdminController::class, 'destroy'])->name('admin.users.destroy');

    // Peminjam
    Route::get('/peminjam', [PeminjamController::class,'index'])->name('admin.peminjam');
    // Route::post('/peminjam/create', [PeminjamController::class,'store'])->name('admin.peminjam.store');
    Route::delete('/peminjam/{peminjam}', [PeminjamController::class, 'destroy'])->name('admin.peminjam.destroy');
    Route::put('/peminjam/{peminjam}', [PeminjamController::class, 'update'])->name('admin.peminjam.update');

    // Petugas
    Route::get('/petugas', [PetugasController::class,'index'])->name('admin.petugas');
    Route::post('/petugas/create', [PetugasController::class,'store'])->name('admin.petugas.store');
    Route::put('/petugas/{petugas}', [PetugasController::class, 'update'])->name('admin.petugas.update');
    Route::delete('/petugas/{petugas}', [PetugasController::class, 'destroy'])->name('admin.petugas.destroy');
    
     // Location Routes
    Route::prefix('location')->group(function () {
    Route::get('/get-provinces', [PeminjamController::class, 'getProvinces']);
    Route::get('/get-kabupaten/{provinsiId}', [PeminjamController::class, 'getKabupatenByProvinsi']);
    Route::get('/get-kecamatan/{kabupatenId}', [PeminjamController::class, 'getKecamatanByKabupaten']);
});
});

require __DIR__.'/auth.php';