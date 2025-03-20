@extends('petugas.layouts.dashboard')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md mb-4">
        <h2 class="text-2xl font-semibold text-gray-800">Selamat Datang, {{ Auth::user()->name }}</h2>
        <p class="text-gray-600 mt-2">Ini adalah dashboard petugas.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Card 1: Total Denda Belum Dibayar -->
        <div class="bg-white shadow-lg rounded-xl p-6 flex items-center space-x-4">
            <div class="p-3 bg-blue-700 text-white rounded-full">
                <i class="fas fa-exclamation-triangle text-xl"></i>             
            </div>
            <div>
                <h3 class="text-gray-700 text-lg font-semibold">Total Denda Belum Dibayar</h3>
                <p class="text-2xl font-bold text-gray-900">{{ $totalDenda }}</p>
            </div>
        </div>
    
        <!-- Card 2: Total Peminjam -->
        <div class="bg-white shadow-lg rounded-xl p-6 flex items-center space-x-4">
            <div class="p-3 bg-green-500 text-white rounded-full">
                <i class="fas fa-users text-xl"></i>
            </div>
            <div>
                <h3 class="text-gray-700 text-lg font-semibold">Total Peminjam</h3>
                <p class="text-2xl font-bold text-gray-900">{{ $totalPeminjaman }}</p>
            </div>
        </div>
    
        <!-- Card 3: Total Pemimjaman -->
        <div class="bg-white shadow-lg rounded-xl p-6 flex items-center space-x-4">
            <div class="p-3 bg-orange-500 text-white rounded-full">
                <i class="fas fa-book-reader text-xl"></i>
            </div>
            <div>
                <h3 class="text-gray-700 text-lg font-semibold">Total Peminjaman</h3>
                <p class="text-2xl font-bold text-gray-900">{{ $totalPeminjaman }}</p>
            </div>
        </div>
    
        <!-- Card 4: Buku yang Telah Dikembalikan -->
        <div class="bg-white shadow-lg rounded-xl p-6 flex items-center space-x-4">
            <div class="p-3 bg-teal-500 text-white rounded-full">
                <i class="fas fa-star text-xl"></i>
            </div>
            <div>
                <h3 class="text-gray-700 text-lg font-semibold">Total Ulasan</h3>
                <p class="text-2xl font-bold text-gray-900">{{ $totalUlasan }}</p>
            </div>
        </div>
    </div>
@endsection
