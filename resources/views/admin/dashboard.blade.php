@extends('admin.layouts.dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <!-- Card 1: Jumlah Buku yang Tersedia -->
    <div class="bg-white shadow-lg rounded-xl p-6 flex items-center space-x-4">
        <div class="p-3 bg-blue-700 text-white rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                <path d="M11.25 4.533A9.707 9.707 0 0 0 6 3a9.735 9.735 0 0 0-3.25.555.75.75 0 0 0-.5.707v14.25a.75.75 0 0 0 1 .707A8.237 8.237 0 0 1 6 18.75c1.995 0 3.823.707 5.25 1.886V4.533ZM12.75 20.636A8.214 8.214 0 0 1 18 18.75c.966 0 1.89.166 2.75.47a.75.75 0 0 0 1-.708V4.262a.75.75 0 0 0-.5-.707A9.735 9.735 0 0 0 18 3a9.707 9.707 0 0 0-5.25 1.533v16.103Z" />
            </svg>              
        </div>
        <div>
            <h3 class="text-gray-700 text-lg font-semibold">Jumlah Buku yang Tersedia</h3>
            <p class="text-2xl font-bold text-gray-900">{{ $totalbukus }}</p>
        </div>
    </div>

    <!-- Card 2: Total Petugas -->
    <div class="bg-white shadow-lg rounded-xl p-6 flex items-center space-x-4">
        <div class="p-3 bg-green-500 text-white rounded-full">
            <i class="fas fa-users text-xl"></i>
        </div>
        <div>
            <h3 class="text-gray-700 text-lg font-semibold">Total Petugas</h3>
            <p class="text-2xl font-bold text-gray-900">{{ $totalpetugas }}</p>
        </div>
    </div>

    <!-- Card 3: Buku yang Dipinjam -->
    <div class="bg-white shadow-lg rounded-xl p-6 flex items-center space-x-4">
        <div class="p-3 bg-orange-500 text-white rounded-full">
            <i class="fas fa-book-reader text-xl"></i>
        </div>
        <div>
            <h3 class="text-gray-700 text-lg font-semibold">Jumlah Buku yang Dipinjam</h3>
            <p class="text-2xl font-bold text-gray-900">{{ $totalDipinjam }}</p>
        </div>
    </div>

    <!-- Card 4: Buku yang Telah Dikembalikan -->
    <div class="bg-white shadow-lg rounded-xl p-6 flex items-center space-x-4">
        <div class="p-3 bg-teal-500 text-white rounded-full">
            <i class="fas fa-undo-alt text-xl"></i>
        </div>
        <div>
            <h3 class="text-gray-700 text-lg font-semibold">Buku yang Telah Dikembalikan</h3>
            <p class="text-2xl font-bold text-gray-900">{{ $totalDikembalikan }}</p>
        </div>
    </div>

    <!-- Card 5: Buku yang Terlambat -->
    <div class="bg-white shadow-lg rounded-xl p-6 flex items-center space-x-4">
        <div class="p-3 bg-red-500 text-white rounded-full">
            <i class="fas fa-exclamation-circle text-xl"></i>
        </div>
        <div>
            <h3 class="text-gray-700 text-lg font-semibold">Buku yang Terlambat Dikembalikan</h3>
            <p class="text-2xl font-bold text-gray-900">{{ $totalTerlambat }}</p>
        </div>
    </div>
</div>
@endsection
