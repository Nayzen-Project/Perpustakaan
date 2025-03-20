<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Buku\BukuController as AdminBukuController;
use App\Http\Controllers\Admin\Kategori\KategoriController as AdminKategoriController;
use App\Http\Controllers\Admin\Petugas\PetugasController as AdminPetugasController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\User\UserController as AdminUserController;
use App\Http\Controllers\Petugas\Denda\DendaController;
use App\Http\Controllers\Petugas\Peminjam\PeminjamController;
use App\Http\Controllers\Petugas\Peminjaman\PeminjamanController as PetugasPeminjamanController;
use App\Http\Controllers\Petugas\PetugasController;
use App\Http\Controllers\Petugas\Ulasan\UlasanController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\Buku\BukuController;
use App\Http\Controllers\User\Peminjaman\PeminjamanController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Middleware\CekRole;
use Illuminate\Support\Facades\Route;

// Landing Page
Route::get('/', function () {
    return view('welcome');
});

// User Dashboard
Route::middleware(['auth', CekRole::class.':user'])->group(function () {
    // Home
    Route::get('/dashboard', [UserController::class, 'index'])->name('user.dashboard');
    Route::get('/search', [UserController::class, 'search'])->name('user.search');

    // Buku
    Route::prefix('dashboard/buku')->name('user.buku.')->group(function () {
        Route::get('/', [BukuController::class, 'index'])->name('index'); // Daftar Buku
        Route::get('/kategori/{slug}', [BukuController::class, 'show'])->name('kategori'); // Berdasarkan Kategori
        Route::get('/detail/{slug}', [BukuController::class, 'detail'])->name('detail'); // Detail Buku
        Route::post('/ulasan/{buku}', [BukuController::class, 'tambahUlasan'])->name('ulasan');
    });

    // Peminjaman
    Route::prefix('peminjaman')->name('user.peminjaman.')->group(function () {
        Route::post('/proses/{buku}', [PeminjamanController::class, 'prosesPeminjaman'])->name('proses');
        Route::post('/submit/{buku}', [PeminjamanController::class, 'submitPeminjaman'])->name('submit');
        Route::get('/bukti/{peminjaman}', [PeminjamanController::class, 'buktiPeminjaman'])->name('bukti');
    });

    // Riwayat Peminjaman
    Route::prefix('dashboard')->name('user.')->group(function () {
        Route::get('/daftarpeminjaman', [PeminjamanController::class, 'daftarPeminjaman'])->name('daftar.peminjaman');
    });

    // Koleksi Buku
    Route::prefix('dashboard/koleksi')->name('user.koleksi.')->group(function () {
        Route::get('/', [BukuController::class, 'koleksi'])->name('index'); // Menampilkan Koleksi
        Route::post('/tambah', [BukuController::class, 'tambahBukuKeKoleksi'])->name('tambah'); // Tambah Buku ke Koleksi
        Route::delete('/hapus/{koleksibuku}', [BukuController::class, 'destroy'])->name('hapus'); // Hapus Buku dari Koleksi
    });

    Route::prefix('dashboard/profile')->name('user.profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::get('/create', [ProfileController::class, 'create'])->name('create');
        Route::post('/', [ProfileController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ProfileController::class, 'edit'])->name('edit');
        Route::put('/{id}', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });

     // Location Routes
     Route::prefix('location')->group(function () {
        Route::get('/get-provinces', [ProfileController::class, 'getProvinces']);
        Route::get('/get-kabupaten/{provinsiId}', [ProfileController::class, 'getKabupatenByProvinsi']);
        Route::get('/get-kecamatan/{kabupatenId}', [ProfileController::class, 'getKecamatanByKabupaten']);
        });
});

// Petugas Dashboard
Route::middleware(['auth', CekRole::class.':petugas'])->prefix('petugas')->group(function () {
    Route::get('/dashboard', [PetugasController::class, 'index'])->name('petugas.dashboard');

    // Peminjam
    Route::get('/peminjam', [PeminjamController::class,'index'])->name('petugas.peminjam');
    Route::post('/peminjam/create', [PeminjamController::class,'store'])->name('petugas.peminjam.store');
    Route::delete('/peminjam/{peminjam}', [PeminjamController::class, 'destroy'])->name('petugas.peminjam.destroy');
    Route::put('/peminjam/{peminjam}', [PeminjamController::class, 'update'])->name('petugas.peminjam.update');
    // Status Active-NonActive
    Route::put('/peminjam/{id}/toggle', [PeminjamController::class, 'toggleStatus'])->name('petugas.peminjam.toggle');

    // Peminjaman
    Route::get('/peminjaman', [PetugasPeminjamanController::class,'index'])->name('petugas.peminjaman');
    Route::put('/peminjaman/{peminjaman}', [PetugasPeminjamanController::class, 'update'])->name('petugas.peminjaman.update');
    Route::delete('/petugas/peminjaman/{peminjaman}', [PetugasPeminjamanController::class, 'destroy'])->name('petugas.peminjaman.destroy');

    // Denda
    Route::get('/denda', [DendaController::class,'index'])->name('petugas.denda');
    Route::put('/denda/{denda}', [DendaController::class, 'update'])->name('petugas.denda.update');
    Route::delete('/denda/{denda}', [DendaController::class, 'destroy'])->name('petugas.denda.destroy');
    
    // Ulasan
    Route::get('/ulasan', [UlasanController::class,'index'])->name('petugas.ulasan');
    Route::put('/ulasan/{ulasan}', [UlasanController::class, 'update'])->name('petugas.ulasan.update');
    Route::delete('/ulasan/{ulasan}', [UlasanController::class, 'destroy'])->name('petugas.ulasan.destroy');

    // Location Routes
    Route::prefix('location')->group(function () {
    Route::get('/get-provinces', [PeminjamController::class, 'getProvinces']);
    Route::get('/get-kabupaten/{provinsiId}', [PeminjamController::class, 'getKabupatenByProvinsi']);
    Route::get('/get-kecamatan/{kabupatenId}', [PeminjamController::class, 'getKecamatanByKabupaten']);
    });

    Route::delete('/logout', [PetugasController::class, 'destroy'])->name('logout');
});

// Admin Dashboard
Route::middleware(['auth', CekRole::class.':admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Petugas
    Route::get('/petugas', [AdminPetugasController::class,'index'])->name('admin.petugas');
    Route::post('/petugas/create', [AdminPetugasController::class,'store'])->name('admin.petugas.store');
    Route::put('/petugas/{petugas}', [AdminPetugasController::class, 'update'])->name('admin.petugas.update');
    Route::delete('/petugas/{petugas}', [AdminPetugasController::class, 'destroy'])->name('admin.petugas.destroy');
    
    // Buku
    Route::get('/buku', [AdminBukuController::class,'index'])->name('admin.buku');
    Route::post('/buku/create', [AdminBukuController::class,'store'])->name('admin.buku.store');
    Route::put('/buku/{buku}', [AdminBukuController::class, 'update'])->name('admin.buku.update');
    Route::delete('/buku/{buku}', [AdminBukuController::class, 'destroy'])->name('admin.buku.destroy');
    
    // Kategori
    Route::get('/kategori', [AdminKategoriController::class,'index'])->name('admin.kategori');
    Route::post('/kategori/create', [AdminKategoriController::class,'store'])->name('admin.kategori.store');
    Route::delete('/kategori/{kategori}', [AdminKategoriController::class, 'destroy'])->name('admin.kategori.destroy');

    // User
    Route::get('/user', [AdminUserController::class, 'index'])->name('admin.user');
    Route::post('/confirm-user/{id}', [AdminUserController::class, 'confirmUser'])->name('admin.confirm-user');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [AdminProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [AdminProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [AdminProfileController::class, 'destroy'])->name('profile.destroy');
    });
});

require __DIR__.'/auth.php';