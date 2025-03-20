<?php

namespace App\Http\Controllers\Petugas\Denda;

use App\Http\Controllers\Controller;
use App\Models\Denda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DendaController extends Controller
{
    public function index()
    {
        $dendas = Denda::with('peminjaman.peminjam')->get();
        return view('petugas.layouts.pages.denda.data-denda', compact('dendas'))->with('title','Denda');
    }

    // Update Denda
    public function update(Request $request, Denda $denda)
    {
        // Validasi input
        $request->validate([
            'nominal' => 'required|integer|min:0',
            'status' => 'required|in:dibayar,belum dibayar',
        ]);

        // Update data denda menggunakan query builder atau Eloquent
        DB::table('dendas')
            ->where('id', $denda->id) // Menggunakan $denda untuk mengetahui ID yang ingin diupdate
            ->update([
                'nominal' => $request->nominal,
                'dibayar' => $request->status == 'dibayar' ? true : false,
                'status' => $request->status,
                'updated_at' => now(), // Menambahkan waktu update
            ]);

        // Redirect dengan pesan sukses
        return redirect()->route('petugas.denda')->with('success', 'Denda berhasil diperbarui!');
    }

    public function destroy(Denda $denda)
    {
        // Menghapus denda yang dipilih
        $denda->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('petugas.denda')->with('success', 'Denda berhasil dihapus!');
    }
}
