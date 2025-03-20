<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\KategoriBuku;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $populerKategori = KategoriBuku::withCount('bukus')
            ->orderByDesc('bukus_count')
            ->first(); 

        $recommendedBooks = $populerKategori
            ? Buku::whereHas('kategori', function ($query) use ($populerKategori) {
                $query->where('kategori_buku_id', $populerKategori->id);
            })->take(6)->get()
            : collect();

        $bukus = Buku::with('kategori')->take(6)->get();
        
        $kategoris = KategoriBuku::all();

        return view('user.dashboard', compact('bukus', 'kategoris', 'recommendedBooks'));
    }

    public function search(Request $request)
    {
        $query = $request->input('q'); // Ambil input pencarian

        // Cari buku berdasarkan judul atau kategori
        $bukus = Buku::where('judul', 'like', "%{$query}%")
                    ->orWhereHas('kategori', function ($q) use ($query) {
                        $q->where('nama_kategori', 'like', "%{$query}%");
                    })
                    ->get();

        $recommendedBooks = Buku::inRandomOrder()->take(6)->get();
        $kategoris = KategoriBuku::all();

        return view('user.dashboard', compact('bukus', 'kategoris', 'recommendedBooks', 'query'));
    }
}
