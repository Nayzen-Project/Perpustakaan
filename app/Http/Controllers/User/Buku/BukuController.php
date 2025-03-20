<?php

namespace App\Http\Controllers\User\Buku;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\KategoriBuku;
use App\Models\KoleksiBuku;
use App\Models\Peminjam;
use App\Models\Ulasan;
use Illuminate\Support\Facades\Auth;


class BukuController extends Controller
{
    // Menampilkan daftar buku
    public function index()
    {
        $bukus = Buku::with('kategori')->get();
        $kategoris = KategoriBuku::all();
        return view('user.layouts.pages.buku.daftar-buku', compact('kategoris', 'bukus'))->with('selectedKategori', null);
    }

    // Menampilkan buku berdasarkan kategori
    public function show($slug)
    {
        $selectedKategori = KategoriBuku::where('slug', $slug)->firstOrFail();
        $bukus = $selectedKategori->bukus; // Mengambil semua buku dalam kategori ini
        $kategoris = KategoriBuku::all();

        return view('user.layouts.pages.buku.daftar-buku', compact('bukus', 'kategoris', 'selectedKategori'));
    }

    // Menampilkan detail buku
    public function detail($slug)
    {
        // Cari buku berdasarkan slug
        $buku = Buku::where('slug', $slug)->firstOrFail();
        $ulasans = Ulasan::where('buku_id', $buku->id)->latest()->get();

        return view('user.layouts.pages.buku.detail-buku', compact('buku', 'ulasans'));
    }

    public function tambahUlasan(Request $request, Buku $buku)
    {
        $request->validate([
            'ulasan' => 'required|string|max:500',
        ]);

        $peminjam = Peminjam::where('user_id', Auth::id())->first();

        if (!$peminjam) {
            return redirect()->back()->with('error', 'Anda belum terdaftar sebagai peminjam.');
        }

        $buku->ulasans()->create([
            'peminjam_id' => $peminjam->id,
            'ulasan' => $request->ulasan,
        ]);

        return redirect()->back()->with('success', 'Ulasan berhasil ditambahkan!');
    }

    // Menampilkan koleksi buku pengguna
    public function koleksi()
    {
        $koleksiBukus = KoleksiBuku::where('user_id', Auth::id())->with('buku')->get();
        return view('user.layouts.pages.buku.koleksi-buku', compact('koleksiBukus'));
    }

    // Menambahkan buku ke koleksi pengguna
    public function tambahBukuKeKoleksi(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:bukus,id',
        ]);

        // Cek apakah buku sudah ada dalam koleksi pengguna
        $exists = KoleksiBuku::where('user_id', Auth::id())
                            ->where('buku_id', $request->buku_id)
                            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'Buku sudah ada dalam koleksi.');
        }

        // Tambahkan buku ke koleksi
        KoleksiBuku::create([
            'user_id' => Auth::id(),
            'buku_id' => $request->buku_id,
        ]);

        return redirect()->route('user.koleksi.index')->with('success', 'Buku berhasil ditambahkan ke koleksi.');
    }

    public function destroy(KoleksiBuku $koleksibuku)
    {
        $userId = Auth::id();

        if ($koleksibuku->user_id !== $userId && $koleksibuku->peminjam_id !== $userId) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menghapus buku ini dari koleksi.');
        }

        $koleksibuku->delete();

        return redirect()->back()->with('success', 'Buku berhasil dihapus dari koleksi.');
    }

}
