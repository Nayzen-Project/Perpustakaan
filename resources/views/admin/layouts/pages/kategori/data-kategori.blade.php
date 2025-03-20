@extends('admin.layouts.dashboard')

@section('title', $title)

@section('content')
@vite(['resources/css/app.css', 'resources/js/app.js'])
    <div class="flex justify-between items-center p-4 bg-gray-50 border-b border-gray-200 rounded-t-lg">
        <div class="space-x-2">
            <button data-modal-target="kategori-modal" data-modal-toggle="kategori-modal" class="flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none transition-all duration-200 ease-in-out shadow-md transform hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v14m7-7H5" />
                </svg>
                Add Kategori
            </button>
        </div>
    </div>

    <div class="px-4 py-2 bg-white rounded-b-lg shadow-sm border-x-2 border-b-2 border-gray-200">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                    <tr>
                        <th scope="col" class="px-6 py-3">Nama Kategori</th>
                        <th scope="col" class="px-6 py-3">Kode Buku</th>
                        <th scope="col" class="px-6 py-3">Jumlah Buku</th>
                        <th scope="col" class="px-6 py-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kategoris as $kategori)
                        <tr class="bg-white border-b hover:bg-gray-50">                                                                             
                            <td class="px-6 py-4">{{ $kategori->nama_kategori }}</td>
                            <td class="px-6 py-4">{{ $kategori->kode }}</td>
                            <td class="px-6 py-4">{{ $kategori->bukus_count }}</td>
                            <td class="px-6 py-4 flex items-center space-x-2">
                                <button data-modal-target="delete-modal-{{ $kategori->id }}" data-modal-toggle="delete-modal-{{ $kategori->id }}" 
                                    class="w-10 h-10 flex justify-center items-center rounded-full bg-blue-600 hover:bg-blue-500 focus:outline-none shadow-md transform transition-all duration-200 ease-in-out hover:scale-110 active:scale-95">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-2 14H7L5 7M15 7V4a3 3 0 00-3-3h-2a3 3 0 00-3 3v3m6 0H9" />
                                    </svg>
                                </button>                    
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="px-6 py-4 text-center text-gray-500">Tidak ada kategori buku</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @include('admin.layouts.pages.kategori.tambah')
    @include('admin.layouts.pages.kategori.delete')
@endsection
