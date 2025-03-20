@extends('user.layouts.dashboard')

@section('content')
<main class="flex flex-1 p-6 justify-center">
    <div class="w-full max-w-3xl bg-white shadow-lg rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-6 flex items-center">
            <span class="mr-2">👤</span> Profile
        </h1>

        <div class="flex flex-col items-center space-y-6">
            <!-- Profile Image -->
            <div class="flex flex-col items-center w-full">
                @if($peminjam && $peminjam->photo)
                    <img src="{{ asset('storage/' . $peminjam->photo) }}"
                         alt="User Avatar"
                         class="w-28 h-28 rounded-full border border-gray-300 object-cover">
                @else
                    <img src="https://api.dicebear.com/9.x/identicon/svg?seed={{ Auth::user()->id }}"
                         alt="User Avatar"
                         class="w-28 h-28 rounded-full border border-gray-300 object-cover">
                @endif
                <h2 class="mt-4 text-lg font-semibold text-gray-900">{{ Auth::user()->name }}</h2>
                <p class="text-gray-600 text-sm">{{ Auth::user()->email }}</p>
            </div>

            @if($peminjam)
            <div class="mt-6 w-full">
                <h3 class="text-lg font-semibold mb-4">Data Lengkap</h3>
                <div class="bg-gray-100 p-6 rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                            <input type="text" value="{{ $peminjam->nama_lengkap }}" class="w-full border border-gray-300 rounded-lg p-2 bg-gray-200" readonly>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">NIK</label>
                            <input type="text" value="{{ $peminjam->nik ?? 'Belum Diisi' }}" class="w-full border border-gray-300 rounded-lg p-2 bg-gray-200" readonly>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Provinsi</label>
                            <input type="text" value="{{ $peminjam->location['provinsi'] ?? 'N/A' }}" class="w-full border border-gray-300 rounded-lg p-2 bg-gray-200" readonly>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Kabupaten</label>
                            <input type="text" value="{{ $peminjam->location['kabupaten'] ?? 'N/A' }}" class="w-full border border-gray-300 rounded-lg p-2 bg-gray-200" readonly>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Kecamatan</label>
                            <input type="text" value="{{ $peminjam->location['kecamatan'] ?? 'N/A' }}" class="w-full border border-gray-300 rounded-lg p-2 bg-gray-200" readonly>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Alamat</label>
                            <textarea class="w-full border border-gray-300 rounded-lg p-2 bg-gray-200" readonly>{{ $peminjam->alamat }}</textarea>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Nomor HP</label>
                            <input type="text" value="{{ $peminjam->phone }}" class="w-full border border-gray-300 rounded-lg p-2 bg-gray-200" readonly>
                        </div>

                        <!-- Foto KTP -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Foto KTP</label>
                            <div class="flex items-center justify-center border border-gray-300 rounded-lg p-2 bg-gray-200">
                                @if($peminjam->foto_ktp)
                                    <img src="{{ asset('storage/' . $peminjam->foto_ktp) }}" alt="Foto KTP" class="w-64 h-auto rounded-lg shadow-lg">
                                @else
                                    <p class="text-gray-500">Belum Ada Foto KTP</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex justify-end space-x-3">
                    <a href="{{ route('user.profile.edit', $peminjam->id) }}" class="inline-block px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300">
                        Perbarui Data
                    </a>
                    <a href="{{ route('user.dashboard')}}" class="inline-block px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition duration-300">
                        Kembali
                    </a>
                </div>  
            </div>
            @else
            <div class="mt-6 text-center">
                <p class="text-gray-600 text-lg mb-4">Data Belum Lengkap! Silakan Lengkapi Data Terlebih Dahulu.</p>
                
                <div class="space-x-3">
                    <a href="{{ route('user.profile.create') }}" class="inline-block px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300">
                        Tambah Data
                    </a>
                    <a href="{{ route('user.dashboard')}}" class="inline-block px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition duration-300">
                        Kembali
                    </a>
                </div>
            </div>            
            @endif
        </div>
    </div>
</main>
@endsection
