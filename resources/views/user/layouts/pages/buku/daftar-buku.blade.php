@extends('user.layouts.dashboard')

@section('content')
<!-- Daftar Buku-->
<div class="bg-white w-full shadow-lg p-6">
    <section class="flex-1">
        <!-- Header Panel -->
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">📚 {{ $selectedKategori ? $selectedKategori->nama_kategori : 'Semua Buku' }}</h1>

            <div class="flex items-center space-x-4">
                @if($selectedKategori)
                    <a href="{{ route('user.buku.index') }}" class="px-4 py-2 bg-gray-200 text-black rounded-md hover:bg-gray-300 transition">
                        ⬅ Kembali
                    </a>
                @endif

                <!-- Filter Dropdown -->
                <div class="relative">
                    <button id="dropdownButton" class="flex items-center bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded-md transition">
                        <span class="mr-2">Filter Kategori</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                            <path fill-rule="evenodd" d="M5.25 8.25a.75.75 0 0 1 .75-.75h12a.75.75 0 0 1 .53 1.28l-6 6a.75.75 0 0 1-1.06 0l-6-6a.75.75 0 0 1-.22-.53z" clip-rule="evenodd"/>
                        </svg>
                    </button>

                    <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-white border rounded-md shadow-lg z-10">
                        <a href="{{ route('user.buku.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">All</a>
                        @foreach($kategoris as $kategori)
                            <a href="{{ route('user.buku.kategori', $kategori->slug) }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">
                                {{ $kategori->nama_kategori }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- Buku Sesuai Kategori -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($bukus as $buku)
                    <div class="relative bg-white p-4 rounded-lg border border-gray-300 shadow-lg hover:shadow-xl transition-transform duration-300 transform hover:scale-105 overflow-hidden">
                        @if($buku->jumlah <= 0)
                            <div class="absolute top-0 right-0 bg-red-500 text-white text-sm font-bold px-3 py-1 rounded-tl-lg rounded-bl-lg">
                                STOK HABIS
                            </div>
                        @endif

                        @if($buku->created_at >= now()->subDays(7))
                            <div class="absolute top-0 left-0 bg-green-500 text-white text-sm font-bold px-3 py-1 rounded-tr-lg rounded-br-lg">
                                NEW
                            </div>
                        @endif

                    <a href="{{ route('user.buku.detail', $buku->slug) }}">
                        <img src="{{ asset($buku->foto) }}" class="w-full h-40 object-cover rounded-md mb-3" />
                    </a>
                    <h3 class="text-md font-semibold truncate">
                        <a href="{{ route('user.buku.detail', $buku->slug) }}">{{ $buku->judul }}</a>
                    </h3>
                    <div class="flex justify-between items-center">
                        <p class="text-sm text-gray-500">{{ $buku->penulis }}</p>
                        <span class="px-2 py-0.5 rounded-full text-xs font-medium border 
                            @if($buku->jumlah > 5) border-green-300 text-green-700 bg-green-100
                            @elseif($buku->jumlah > 0) border-yellow-300 text-yellow-700 bg-yellow-100
                            @else border-red-300 text-red-700 bg-red-100
                            @endif">
                            {{ $buku->jumlah > 0 ? "$buku->jumlah buku" : "Stok Habis" }}
                        </span>
                    </div>
                    
                    <div class="flex flex-wrap gap-2 mt-2">
                        @foreach($buku->kategori as $k)
                            <span class="px-3 py-1 rounded-full text-xs font-medium border border-gray-300 text-gray-700 bg-gray-100">
                                {{ $k->nama_kategori }}
                            </span>
                        @endforeach
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('user.buku.detail', $buku->slug) }}" class="text-blue-500 hover:underline text-sm">Lihat Buku</a>
                    </div>
                </div>
            @empty
                <div class="col-span-4 text-center text-gray-500">
                    📖 Tidak ada buku dalam kategori ini.
                </div>
            @endforelse
        </div>
    </section>
</div>
<script>
    document.getElementById('dropdownButton').addEventListener('click', function () {
        document.getElementById('dropdownMenu').classList.toggle('hidden');
    });
</script>
@endsection

