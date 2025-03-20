@extends('user.layouts.dashboard')

@section('content')
<div class="py-6 bg-white w-full h-screen">
    <div class="container mx-auto p-6">
        <h2 class="text-xl font-semibold mb-4">Koleksi Buku Saya</h2>

        @if($koleksiBukus->isEmpty())
            <p class="text-gray-600">Belum ada buku dalam koleksi.</p>
        @else
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($koleksiBukus as $item)
                <div class="relative group bg-white rounded-lg border border-gray-300 shadow-lg hover:shadow-2xl transition-transform duration-300 transform hover:-translate-y-2 overflow-hidden w-64 h-80">
                    <a href="{{ route('user.buku.detail', $item->buku->slug) }}">
                        <img src="{{ asset($item->buku->foto) }}" alt="{{ $item->buku->judul }}" class="object-cover w-full h-56 group-hover:scale-110 transition-transform duration-500 rounded-t-lg">
                    </a>
                    
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800 truncate">{{ $item->buku->judul }}</h3>
                        <p class="text-sm text-gray-500">{{ $item->buku->penulis }}</p>
                    </div>
                    
                    <!-- Tombol Aksi Muncul Saat Hover -->
                    <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-center items-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <a href="{{ route('user.buku.detail', $item->buku->slug) }}"  class="text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-lg text-sm mb-2">Lihat Detail</a>
                        <button data-modal-target="delete-modal-{{ $item->id }}" class="text-white bg-red-600 hover:bg-red-700 px-4 py-2 rounded-lg text-sm">Hapus</button>
                    </div>
                </div>
                
                <!-- Modal Konfirmasi Hapus -->
                <div id="delete-modal-{{ $item->id }}" class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-black bg-opacity-40">
                    <div class="relative p-4 w-full max-w-md max-h-full">
                        <div class="relative bg-gray-50 rounded-lg shadow-2xl">
                            <button type="button" class="absolute top-3 right-3 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 flex justify-center items-center" data-modal-hide="delete-modal-{{ $item->id }}">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                            </button>
                            <div class="p-6 text-center">
                                <svg class="mx-auto mb-4 text-red-600 w-12 h-12" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                </svg>
                                <h3 class="mb-5 text-lg font-medium text-gray-800">Yakin ingin menghapus koleksi ini?</h3>
                                <form id="delete-form-{{ $item->id }}" action="{{ route('user.koleksi.hapus', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <div class="flex justify-center space-x-4">
                                    <button type="button" class="text-white bg-red-600 hover:bg-red-700 font-medium rounded-lg text-sm px-6 py-2.5" onclick="document.getElementById('delete-form-{{ $item->id }}').submit();">
                                        Ya, Hapus
                                    </button>
                                    <button type="button" class="py-2.5 px-5 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-blue-700" data-modal-hide="delete-modal-{{ $item->id }}">
                                        Tidak, Batalkan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<!-- Script untuk Modal -->
<script>
document.querySelectorAll("[data-modal-target]").forEach(button => {
    button.addEventListener("click", function() {
        let modalId = this.getAttribute("data-modal-target");
        document.getElementById(modalId).classList.remove("hidden");
    });
});

document.querySelectorAll("[data-modal-hide]").forEach(button => {
    button.addEventListener("click", function() {
        let modalId = this.getAttribute("data-modal-hide");
        document.getElementById(modalId).classList.add("hidden");
    });
});
</script>
@endsection
