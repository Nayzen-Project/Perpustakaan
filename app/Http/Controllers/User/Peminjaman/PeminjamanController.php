<?php

namespace App\Http\Controllers\User\Peminjaman;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Peminjaman;
use App\Models\ListPeminjaman;
use App\Models\Buku;
use App\Models\Denda;
use App\Models\Peminjam;
use App\Models\Petugas;
use Carbon\Carbon;
use Illuminate\Support\Str;

class PeminjamanController extends Controller
{
    /**
     * Menampilkan halaman proses peminjaman setelah modal dikirim.
     */
    public function prosesPeminjaman(Request $request, Buku $buku)
    {
        $peminjam = Auth::user()->peminjam;

        // Cek apakah user sudah melengkapi data peminjam
        if (!$peminjam || !$this->isDataLengkap($peminjam)) {
            return redirect()->back()->with('error_data', 'Anda harus melengkapi data terlebih dahulu.');
        }

        // Cek ketersediaan buku sebelum memproses peminjaman
        if ($buku->jumlah < 1) {
            return redirect()->back()->with('error', 'Stok buku habis.');
        }

        // Validasi input tanggal peminjaman
        $request->validate([
            'tanggal_peminjaman' => 'required|date|after_or_equal:today',
        ]);

        return view('user.layouts.pages.peminjaman.proses-peminjaman', [
            'buku' => $buku,
            'peminjam' => $peminjam,
            'tanggal_peminjaman' => $request->tanggal_peminjaman,
            'tanggal_pengembalian' => Carbon::parse($request->tanggal_peminjaman)->addDays(7)->toDateString(),
        ]);
    }

    /**
     * Menyimpan peminjaman buku.
     */
    public function submitPeminjaman(Request $request, Buku $buku)
    {
        $peminjam = Auth::user()->peminjam;

        if (!$peminjam || !$this->isDataLengkap($peminjam)) {
            return redirect()->back()->with('error', 'Anda harus melengkapi data terlebih dahulu.');
        }

        // Validasi input tanggal
        $request->validate([
            'tanggal_peminjaman' => 'required|date|after_or_equal:today',
            'tanggal_pengembalian' => 'required|date|after:tanggal_peminjaman',
        ]);

        // Pastikan buku tersedia
        if ($buku->jumlah < 1) {
            return redirect()->back()->with('error', 'Stok buku habis.');
        }

        // Pilih petugas secara acak
        $petugas = Petugas::inRandomOrder()->first();

        // Simpan data peminjaman
        $peminjaman = Peminjaman::create([
            'kode_peminjaman' => 'PMX-' . strtoupper(Str::random(3)),
            'peminjam_id' => $peminjam->id,
            'petugas_id' => $petugas ? $petugas->id : null,
            'tanggal_peminjaman' => $request->tanggal_peminjaman,
            'tanggal_pengembalian' => $request->tanggal_pengembalian,
            'status' => 'menunggu pengambilan',
        ]);

        // Simpan detail buku yang dipinjam
        ListPeminjaman::create([
            'peminjaman_id' => $peminjaman->id,
            'buku_id' => $buku->id,
        ]);

        // Kurangi stok buku
        $buku->decrement('jumlah');

        return redirect()->route('user.peminjaman.bukti', $peminjaman->id)
                         ->with('success', 'Buku berhasil dipinjam.');
    }

    /**
     * Halaman bukti peminjaman.
     */
    public function buktiPeminjaman(Peminjaman $peminjaman)
    {
        $peminjam = Auth::user()->peminjam;

        if (!$peminjam || $peminjaman->peminjam_id !== $peminjam->id) {
            return redirect()->route('user.buku.index')->with('error', 'Anda tidak memiliki akses ke bukti ini.');
        }

        // Gunakan load() untuk menghindari N+1 Query Problem
        $peminjaman->load('listPeminjaman.buku');

        return view('user.layouts.pages.peminjaman.bukti-peminjaman', compact('peminjaman'));
    }

    /**
     * Periksa apakah data peminjam sudah lengkap.
     */
    private function isDataLengkap($peminjam)
    {
        return !empty($peminjam->nama_lengkap) && !empty($peminjam->alamat) && !empty($peminjam->phone);
    }

    /**
     * Menampilkan daftar riwayat peminjaman user.
     */
    public function daftarPeminjaman()
    {
        $peminjam = Auth::user()->peminjam;

        if (!$peminjam) {
            return redirect()->route('user.buku.index')->with('error', 'Anda belum terdaftar sebagai peminjam.');
        }

        $riwayat_peminjaman = Peminjaman::where('peminjam_id', $peminjam->id)
            ->with('listPeminjaman.buku','denda')
            ->orderBy('tanggal_peminjaman', 'desc')
            ->paginate(10);

        return view('user.layouts.pages.buku.daftarpeminjaman', compact('riwayat_peminjaman'));
    }
}
