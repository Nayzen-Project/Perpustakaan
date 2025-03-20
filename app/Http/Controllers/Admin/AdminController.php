<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Denda;
use App\Models\KategoriBuku;
use App\Models\KoleksiBuku;
use App\Models\ListKategori;
use App\Models\ListPeminjaman;
use App\Models\Peminjam;
use App\Models\Peminjaman;
use App\Models\Petugas;
use App\Models\Ulasan;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        $totalpetugas = Petugas::count();
        $totalbukus = Buku::count();
        // Jumlah buku yang dipinjam (status "dipinjam")
        $totalDipinjam = Peminjaman::where('status', 'dipinjam')->count();

        // Jumlah buku yang dikembalikan (status "dikembalikan")
        $totalDikembalikan = Peminjaman::where('status', 'dikembalikan')->count();

        // Jumlah buku yang terlambat (tanggal pengembalian lebih kecil dari sekarang dan statusnya "dipinjam")
        $totalTerlambat = Peminjaman::where('status', 'dipinjam')
                                    ->where('tanggal_pengembalian', '<', Carbon::now())
                                    ->count();

        return view('admin.dashboard', compact('totalDipinjam', 'totalDikembalikan', 'totalTerlambat', 'totalbukus', 'totalpetugas'))->with('title','Dashboard');
    }
}
