<?php

namespace App\Http\Controllers\Admin\Kategori;

use App\Http\Controllers\Controller;
use App\Models\KategoriBuku;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = KategoriBuku::withCount('bukus')->get();
        return view('admin.layouts.pages.kategori.data-kategori', compact('kategoris'))->with('title','Kategori Buku');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategori_bukus,nama_kategori',
        ]);
    
        $kode = $this->generateKode($request->nama_kategori);
    
        KategoriBuku::create([
                'nama_kategori' => $request->nama_kategori,
                'kode' => $kode,
        ]);
    
        return redirect()->route('admin.kategori')->with('success', 'Kategori berhasil ditambahkan!');
    }
    
    public function destroy(KategoriBuku $kategori)
    {
    // Perbarui kode buku sebelum menghapus kategori
    foreach ($kategori->bukus as $buku) {
        $buku->kategori()->detach($kategori->id); // Hapus relasi kategori
        $buku->refresh(); // Ambil ulang kategori yang tersisa
        $buku->updateKategoriKode(); // Perbarui kode kategori
    }

    // Hapus kategori
    $kategori->delete();

    return redirect()->route('admin.kategori')->with('success', 'Kategori berhasil dihapus dan kode buku diperbarui!');
    }

    private function generateKode($nama_kategori)
    {
        $words = explode(' ', trim($nama_kategori));
        $kode = strtoupper(implode('', array_map(fn($word) => $word[0], $words)));
        $count = KategoriBuku::where('kode', 'LIKE', $kode . '%')->count();
        return $count > 0 ? $kode . ($count + 1) : $kode;
    }
}
