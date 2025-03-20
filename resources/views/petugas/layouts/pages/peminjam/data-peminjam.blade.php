@extends('petugas.layouts.dashboard')

@section('content')
@vite(['resources/css/app.css', 'resources/js/app.js'])

<div class="bg-white p-6 rounded-lg shadow-md mb-6">
    <h2 class="text-2xl font-semibold text-gray-800">{{ $title }}</h2>
</div>

<div class="px-4 py-2 bg-white rounded-lg shadow-sm border border-gray-200">
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-600">
            <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                <tr>
                    <th scope="col" class="px-6 py-3">Photo</th>
                    <th scope="col" class="px-6 py-3">Nama Lengkap</th>
                    <th scope="col" class="px-6 py-3">Email</th>
                    <th scope="col" class="px-6 py-3">Phone</th>
                    <th scope="col" class="px-6 py-3 text-center">Status</th>
                    <th scope="col" class="px-6 py-3 text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($peminjams as $peminjam)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-6 py-4">
                            @if($peminjam->photo)
                                <img src="{{ asset('storage/' . $peminjam->photo) }}" alt="Avatar" class="w-10 h-10 rounded-full">
                            @else
                                <img src="https://api.dicebear.com/9.x/identicon/svg?seed={{ $peminjam->id }}" alt="Avatar" class="w-10 h-10 rounded-full">
                            @endif
                        </td>                        
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $peminjam->nama_lengkap }}</td>
                        <td class="px-6 py-4">{{ $peminjam->user->email }}</td>
                        <td class="px-6 py-4">{{ $peminjam->phone }}</td>
                        
                        <!-- TOMBOL STATUS (Toggle Aktif/Nonaktif) -->
                        <td class="px-6 py-4 text-center">
                            <form action="{{ route('petugas.peminjam.toggle', $peminjam->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <button type="submit" 
                                    class="px-3 py-1 text-xs font-medium rounded-full 
                                        {{ $peminjam->status === 'active' ? 'bg-gray-200 text-gray-800 hover:bg-gray-300' : 'bg-green-200 text-green-800 hover:bg-green-300' }}">
                                    {{ $peminjam->status === 'active' ? 'Nonaktifkan' : 'Aktifkan' }}
                                </button>
                            </form>
                        </td>

                        <!-- ACTION -->
                        <td class="px-6 py-4 flex justify-center space-x-2">
                            <!-- Detail -->
                            <button type="button" data-modal-target="detail-modal-{{ $peminjam->id }}" data-modal-toggle="detail-modal-{{ $peminjam->id }}" class="p-2 rounded-full border border-blue-500 text-blue-500 hover:bg-blue-100">
                                <i class="fas fa-eye"></i>
                            </button>
                        
                            <!-- Edit -->
                            <button type="button" data-modal-target="edit-modal-{{ $peminjam->id }}" data-modal-toggle="edit-modal-{{ $peminjam->id }}" class="p-2 rounded-full border border-yellow-500 text-yellow-500 hover:bg-yellow-100">
                                <i class="fas fa-edit"></i>
                            </button>
                        
                            <!-- Delete -->
                            <button type="button" data-modal-target="delete-modal-{{ $peminjam->id }}" data-modal-toggle="delete-modal-{{ $peminjam->id }}" class="p-2 rounded-full border border-red-500 text-red-500 hover:bg-red-100">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">Tidak ada data peminjam.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@include('petugas.layouts.pages.peminjam.detail')
@include('petugas.layouts.pages.peminjam.delete')
@include('petugas.layouts.pages.peminjam.edit')

@endsection
