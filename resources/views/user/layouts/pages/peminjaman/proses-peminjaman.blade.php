@extends('user.layouts.dashboard')

@section('content')
<div class="max-w-lg mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
    <h2 class="text-xl font-bold mb-4 text-center">Proses Peminjaman Buku</h2>

    <!-- Data Peminjaman -->
    <div class="mb-4 p-4 border rounded-lg">
        <!-- Bagian Foto Buku -->
        <div class="flex items-center space-x-4">
            <img src="{{ asset($buku->foto) }}" alt="{{ $buku->judul }}" class="w-24 h-32 object-cover rounded-lg shadow-md">
            
            <!-- Informasi Buku -->
            <div>
                <p class="text-lg font-semibold">{{ $buku->judul }}</p>
                <p class="text-sm text-gray-600 flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 text-gray-600">
                        <path d="M3.375 3C2.339 3 1.5 3.84 1.5 4.875v.75c0 1.036.84 1.875 1.875 1.875h17.25c1.035 0 1.875-.84 1.875-1.875v-.75C22.5 3.839 21.66 3 20.625 3H3.375Z" />
                        <path fill-rule="evenodd" d="m3.087 9 .54 9.176A3 3 0 0 0 6.62 21h10.757a3 3 0 0 0 2.995-2.824L20.913 9H3.087Zm6.163 3.75A.75.75 0 0 1 10 12h4a.75.75 0 0 1 0 1.5h-4a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                    </svg>
                    <span class="font-semibold">{{ $buku->code }}</span>
                </p>
            </div>
        </div>

        <hr class="my-4 border-gray-300">

        <!-- Informasi Peminjam -->
        <p class="mb-2"><strong>Nama:</strong> {{ Auth::user()->name }}</p>
        <p class="mb-2"><strong>Tanggal Peminjaman:</strong> {{ $tanggal_peminjaman }}</p>
    </div>

    <!-- Catatan Peminjaman & Denda -->
    <div class="mb-4 p-3 bg-red-200 text-red-800 rounded-lg text-sm">
        ⚠️ Peminjaman buku **paling lambat dikembalikan dalam 7 hari** dari tanggal peminjaman.  
        ⏳ Jika terlambat **lebih dari 7 hari**, akan dikenakan **denda Rp 1.000 per hari**.  
        📚 Jika buku **hilang atau rusak**, peminjam akan dikenakan **denda sesuai ketentuan perpustakaan**.
    </div>

    <!-- Tombol Aksi -->
    <div class="flex justify-between mt-4">
        <a href="{{ route('user.buku.detail', $buku->slug) }}" class="px-4 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500">
            Batal
        </a>
        <form action="{{ route('user.peminjaman.submit', $buku) }}" method="POST">
            @csrf
            <input type="hidden" name="tanggal_peminjaman" value="{{ $tanggal_peminjaman }}">
            <input type="hidden" name="tanggal_pengembalian" value="{{ $tanggal_pengembalian }}">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                Proses
            </button>
        </form>
    </div>
</div>
@endsection
