@extends('user.layouts.dashboard')

@section('content')
<div class="max-w-sm mx-auto mt-10 p-6 bg-white shadow-lg rounded-lg border relative text-sm font-mono">
    <!-- Header Nota -->
    <div class="text-center mb-6 border-b pb-4">
        <h2 class="text-lg font-bold text-gray-800">Ruang Literasi</h2>
        <p class="text-xs text-gray-500">Jl. Pendidikan No. 10, Perpustakaan Kota</p>
        <p class="text-xs text-gray-500">Telp: (021) 1234-5678</p>
    </div>

    <!-- Kode Peminjaman -->
    <div class="text-center mb-4">
        <p class="text-sm font-semibold">Kode Peminjaman:</p>
        <p class="text-lg font-bold tracking-widest text-blue-600">{{ $peminjaman->kode_peminjaman }}</p>
    </div>

    <hr class="border-dashed my-3">

    <!-- Informasi Peminjam -->
    <div class="mb-4">
        <p><strong>Nama:</strong> {{ Auth::user()->name }}</p>
        <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
    </div>

    <hr class="border-dashed my-3">

    <!-- Daftar Buku -->
    <div class="mb-4">
        <p class="text-center font-semibold text-gray-700">Detail Buku</p>
        <hr class="border-dashed my-2">
        @foreach($peminjaman->listPeminjaman as $item)
        <div class="flex justify-between items-center p-2 border-b">
            <div>
                <p class="font-semibold">{{ $item->buku->judul }}</p>
                <p class="text-sm text-gray-600 flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 text-gray-600">
                        <path d="M3.375 3C2.339 3 1.5 3.84 1.5 4.875v.75c0 1.036.84 1.875 1.875 1.875h17.25c1.035 0 1.875-.84 1.875-1.875v-.75C22.5 3.839 21.66 3 20.625 3H3.375Z" />
                        <path fill-rule="evenodd" d="m3.087 9 .54 9.176A3 3 0 0 0 6.62 21h10.757a3 3 0 0 0 2.995-2.824L20.913 9H3.087Zm6.163 3.75A.75.75 0 0 1 10 12h4a.75.75 0 0 1 0 1.5h-4a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                    </svg>
                    <span class="font-semibold">{{ $item->buku->code }}</span>
                </p>
            </div>
        </div>
        @endforeach
    </div>

    <hr class="border-dashed my-3">

    <!-- Detail Peminjaman -->
    <div class="mb-4">
        <p><strong>Tanggal Pinjam:</strong> {{ $peminjaman->tanggal_peminjaman }}</p>
        <p><strong>Tanggal Kembali:</strong> {{ $peminjaman->tanggal_pengembalian }}</p>
        <p><strong>Status:</strong> 
            @php
                $statusColors = [
                    'dipinjam' => 'bg-yellow-500',
                    'dikembalikan' => 'bg-green-500',
                    'menunggu pengambilan' => 'bg-blue-500',
                    'telat dikembalikan' => 'bg-red-500',
                ];
                $statusClass = $statusColors[$peminjaman->status] ?? 'bg-gray-500';
            @endphp
            <span class="px-2 py-1 text-white rounded-lg {{ $statusClass }}">
                {{ ucfirst($peminjaman->status) }}
            </span>
        </p>
    </div>

    <hr class="border-dashed my-3">

    <!-- Footer -->
    <div class="text-center text-xs text-gray-500">
        <p>Terima kasih telah menggunakan layanan kami!</p>
        <p>Harap mengembalikan buku tepat waktu 📅</p>
    </div>

    <div class="flex justify-between mt-6">
        <!-- Tombol Kembali -->
        <a href="{{ route('user.dashboard') }}" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-all text-xs">
            Kembali
        </a>
    
        <!-- Tombol Cetak -->
        <button onclick="window.print()" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all text-xs">
            Cetak
        </button>
    </div>    
</div>
@endsection
