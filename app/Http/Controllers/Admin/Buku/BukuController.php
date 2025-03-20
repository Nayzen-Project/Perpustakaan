<?php

namespace App\Http\Controllers\Admin\Buku;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use Illuminate\Support\Str;
use App\Models\KategoriBuku;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index()
    {
        $kategoris = KategoriBuku::all();
        $bukus = Buku::with('kategori')->get();
        return view('admin.layouts.pages.buku.data-buku', compact('bukus','kategoris'))->with('title', 'Buku');
    }

    public function store(Request $request)
    {
        // dd($request->all());

        // Validasi data
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'description' => 'nullable|string',
            'tahun_terbit' => 'required|integer|min:1000|max:' . date('Y'),
            'kategori' => 'required|array', // kategori diharuskan berupa array
            'kategori.*' => 'exists:kategori_bukus,id', // memastikan kategori ada di tabel kategori_bukus
            'jumlah' => 'required|integer|min:1',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5000',
        ]);

        // Proses upload photo jika ada
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('public/fotobuku'); // Simpan ke storage
            $fotoPath = str_replace('public/', 'storage/', $fotoPath); // Path agar bisa diakses di public
        }

        $kategoris = KategoriBuku::whereIn('id', $request->kategori)->get();
        $kodeKategori = $kategoris->pluck('kode')->implode('');

        // Cari ID terakhir yang ada, jika belum ada maka mulai dari 1
        $lastId = Buku::max('id') ?? 0; 

        // Generate kode unik untuk buku baru
        $kodeBuku = strtoupper($kodeKategori) . str_pad($lastId + 1, 2, '0', STR_PAD_LEFT);

        // Membuat slug otomatis
        $slug = Str::slug($request->judul);

        // Cek apakah slug sudah ada
        if (Buku::where('slug', $slug)->exists()) {
            // Jika slug sudah ada, tambahkan angka di belakang slug
            $slug = $slug . '-' . time();
        }

        // Simpan data buku baru
        $buku = Buku::create([
            'judul' => $request->judul,
            'slug' => $slug,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'description' => $request->description,
            'code' => $kodeBuku,
            'tahun_terbit' => $request->tahun_terbit,
            'jumlah' => $request->jumlah,
            'foto' => $fotoPath,
        ]);

        // Menyimpan kategori (Jika ada relasi many-to-many)
        if ($request->has('kategori')) {
            // Menambahkan kategori ke buku melalui tabel pivot (list_kategoris)
            $buku->kategori()->attach($request->kategori);
        }

        return redirect()->route('admin.buku')->with('success', 'Buku berhasil ditambahkan!');
    }

    public function update(Request $request, Buku $buku)
    {
        // Validasi input
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'description' => 'nullable|string',
            'tahun_terbit' => 'required|integer|min:1000|max:' . date('Y'),
            'kategori' => 'required|array',
            'kategori.*' => 'exists:kategori_bukus,id',
            'jumlah' => 'required|integer|min:1',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5000',
        ]);

        // Ambil kategori baru yang dipilih
        $kategoris = KategoriBuku::whereIn('id', $request->kategori)->get();
        $kodeKategori = $kategoris->pluck('kode')->implode('');

        // Generate kode buku baru berdasarkan kategori yang dipilih
        $kodeBuku = strtoupper($kodeKategori) . str_pad($buku->id, 2, '0', STR_PAD_LEFT);

        // Membuat slug otomatis
        $slug = Str::slug($request->judul);

        // Cek apakah slug sudah ada, jika ada tambahkan angka
        if (Buku::where('slug', $slug)->exists()) {
            $slug = $slug . '-' . time();
        }

        // Update Data Buku
        $buku->update([
            'judul' => $request->judul,
            'slug' => $slug,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'description' => $request->description,
            'tahun_terbit' => $request->tahun_terbit,
            'jumlah' => $request->jumlah,
            'code' => $kodeBuku, // Update kode buku
        ]);

        // Jika ada file foto baru diunggah, hapus foto lama dan simpan yang baru
        if ($request->hasFile('foto')) {
            if ($buku->foto) {
                Storage::delete(str_replace('storage/', 'public/', $buku->foto));
            }

            $fotoPath = $request->file('foto')->store('public/fotobuku');
            $buku->update(['foto' => str_replace('public/', 'storage/', $fotoPath)]);
        }

        // Update kategori buku (relasi many-to-many)
        if ($request->has('kategori')) {
            $buku->kategori()->sync($request->kategori);
        }

        return redirect()->route('admin.buku')->with('success', 'Buku berhasil diperbarui!');
    }

    public function destroy(Buku $buku)
    {
        // Hapus foto dari storage jika ada
        if ($buku->foto) {
            Storage::delete(str_replace('storage/', 'public/', $buku->foto));
        }

        $buku->delete();

        return redirect()->route('admin.buku')->with('success', 'buku deleted successfully');
    }
}
