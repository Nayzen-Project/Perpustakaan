<?php

namespace App\Http\Controllers\Petugas\Peminjaman;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use App\Models\Denda;
use Carbon\Carbon;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjamen = Peminjaman::with('peminjam','petugas')->paginate(10);
        return view('petugas.layouts.pages.peminjaman.data-peminjaman', compact('peminjamen'))->with('title','Peminjaman');
    }

    public function update(Request $request, Peminjaman $peminjaman)
    {
        $request->validate([
            'tanggal_dikembalikan' => 'required|date|after_or_equal:tanggal_peminjaman',
            'status' => 'required|in:dipinjam,dikembalikan,telat dikembalikan',
        ]);

        // Update data peminjaman
        $peminjaman->update([
            'tanggal_dikembalikan' => $request->tanggal_dikembalikan,
            'status' => $request->tanggal_dikembalikan > $peminjaman->tanggal_pengembalian ? 'telat dikembalikan' : 'dikembalikan',
        ]);

        // Cek denda setelah update
        $this->cekDenda($peminjaman);

        return redirect()->route('petugas.peminjaman')->with('success', 'Peminjaman berhasil diperbarui!');
    }


    public function cekDenda(Peminjaman $peminjaman)
    {
        // Pastikan buku sudah dikembalikan sebelum menghitung denda
        if (!$peminjaman->tanggal_dikembalikan) {
            return;
        }

        $batas_pengembalian = Carbon::parse($peminjaman->tanggal_pengembalian);
        $tanggal_dikembalikan = Carbon::parse($peminjaman->tanggal_dikembalikan);

        // Hitung keterlambatan
        $keterlambatan = max(0, $batas_pengembalian->diffInDays($tanggal_dikembalikan, false));

        if ($keterlambatan > 0) {
            $total_denda = $keterlambatan * 1000; // Misal denda Rp 1000 per hari

            // Simpan atau update data denda
            Denda::updateOrCreate(
                ['peminjaman_id' => $peminjaman->id], // Kondisi unik
                ['nominal' => $total_denda, 'dibayar' => false, 'status' => 'belum dibayar']
            );
        } else {
            // Jika tidak ada keterlambatan, hapus denda
            Denda::where('peminjaman_id', $peminjaman->id)->delete();
        }
    }

    public function destroy(Peminjaman $peminjaman)
    {
        // Hapus data denda yang terkait dengan peminjaman
        Denda::where('peminjaman_id', $peminjaman->id)->delete();

        // Hapus data peminjaman
        $peminjaman->delete();

        return redirect()->route('petugas.peminjaman')->with('success', 'Peminjaman berhasil dihapus!');
    }
}
