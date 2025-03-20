@extends('user.layouts.dashboard')
@section('content')
<div class="p-6">
    @php
        $peminjam = \App\Models\Peminjam::where('user_id', auth()->id())->first();
        $userDataLengkap = $peminjam && !empty($peminjam->nama_lengkap) && !empty($peminjam->alamat) && !empty($peminjam->phone);
    @endphp

    <div id="notifikasi-lengkapi-data" class="hidden p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg flex items-center justify-between" role="alert">
        <span class="font-medium">Anda harus melengkapi data terlebih dahulu sebelum dapat meminjam buku.</span>
        <a href="{{ route('user.profile.create') }}" class="ml-2 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
            Lengkapi Data
        </a>
    </div>

    <section class="py-8 bg-white md:py-16 antialiased">
        <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0">
            <div class="lg:grid lg:grid-cols-2 lg:gap-8 xl:gap-16">
                <img src="{{ asset($buku->foto) }}" class="w-full h-auto object-cover" alt="Cover Buku" />
                <div class="mt-6 sm:mt-8 lg:mt-0">
                    <h1 class="text-2xl font-extrabold text-gray-900 sm:text-3xl">{{ $buku->judul }}</h1>
                    
                    <div class="mt-4 sm:flex sm:items-center sm:gap-4">
                        <div class="flex flex-wrap gap-2 mt-2">
                            @foreach($buku->kategori as $k)
                                <span class="px-3 py-1 rounded-full text-xs font-medium border border-gray-300 text-gray-700 bg-gray-100">
                                    {{ $k->nama_kategori }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="mt-6 sm:flex sm:gap-4 sm:items-center sm:mt-8">
                        <form action="{{ route('user.koleksi.tambah') }}" method="POST">
                            @csrf
                            <input type="hidden" name="buku_id" value="{{ $buku->id }}">
                            <button type="submit" class="flex items-center justify-center py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:ring-4 focus:ring-gray-100">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 -ms-2 me-2" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M6.32 2.577a49.255 49.255 0 0 1 11.36 0c1.497.174 2.57 1.46 2.57 2.93V21a.75.75 0 0 1-1.085.67L12 18.089l-7.165 3.583A.75.75 0 0 1 3.75 21V5.507c0-1.47 1.073-2.756 2.57-2.93Z" clip-rule="evenodd"/>
                                </svg>
                                Tambah Koleksi
                            </button>
                        </form>
                        
                        <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition" id="btn-pinjam">
                            Pinjam Buku
                        </button>
                    </div>
                    
                    <hr class="my-6 md:my-8 border-gray-200" />
                    
                    <p class="mb-6 text-gray-500 text-justify">{{ $buku->description }}</p>

                    <hr class="my-6 md:my-8 border-gray-200" />
                    
                    <!-- Bagian Review Buku -->
                    <h2 class="text-xl font-semibold text-gray-900">Review Buku</h2>
                    <form action="{{ route('user.buku.ulasan', $buku) }}" method="POST" class="mt-4">
                        @csrf
                        <textarea name="ulasan" class="w-full p-3 border border-gray-300 rounded-lg" placeholder="Tulis review Anda..." required></textarea>
                        <button type="submit" class="mt-2 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Kirim Review</button>
                    </form>
                    
                    <div class="mt-6">
                        @foreach($buku->ulasans as $ulasan)
                            <div class="p-4 mb-4 border border-gray-300 rounded-lg">
                                <p class="text-gray-700 font-medium">{{ $ulasan->peminjam->nama_lengkap }}</p>
                                <p class="text-gray-600">{{ $ulasan->ulasan }}</p>
                                <p class="text-xs text-gray-400">{{ $ulasan->created_at->diffForHumans() }}</p>
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="mb-4">
                        <a href="{{ route('user.buku.index')}}" class="flex items-center text-gray-900 hover:text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                <path fill-rule="evenodd" d="M9.53 2.47a.75.75 0 0 1 0 1.06L4.81 8.25H15a6.75 6.75 0 0 1 0 13.5h-3a.75.75 0 0 1 0-1.5h3a5.25 5.25 0 1 0 0-10.5H4.81l4.72 4.72a.75.75 0 1 1-1.06 1.06l-6-6a.75.75 0 0 1 0-1.06l6-6a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" />
                            </svg>
                            <span class="ml-2">Back</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
    const btnPinjam = document.getElementById("btn-pinjam");
    const modal = document.getElementById("peminjaman-modal");
    const closeModalBtn = document.getElementById("close-modal-btn");
    const closeXBtn = document.getElementById("close-modal");
    const notifikasiLengkapiData = document.getElementById("notifikasi-lengkapi-data");
    const userDataLengkap = @json($userDataLengkap);

    btnPinjam.addEventListener("click", function () {
        if (!userDataLengkap) {
            notifikasiLengkapiData.classList.remove("hidden");
        } else {
            modal.classList.remove("hidden");
        }
    });

    // Fungsi untuk menutup modal dengan tombol X
    closeXBtn.addEventListener("click", function () {
        modal.classList.add("hidden");
    });

    // Fungsi untuk menutup modal dengan tombol Batal
    closeModalBtn.addEventListener("click", function () {
        modal.classList.add("hidden");
    });

    // Klik di luar modal untuk menutup
    modal.addEventListener("click", function (e) {
        if (e.target === modal) {
            modal.classList.add("hidden");
        }
    });
});

</script>

@include('user.layouts.pages.peminjaman.modal-peminjaman')
@endsection
