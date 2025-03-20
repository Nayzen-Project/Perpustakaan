@extends('admin.layouts.dashboard')

@section('title', $title)

@section('content')
@vite(['resources/css/app.css', 'resources/js/app.js'])
    <div class="flex justify-between items-center p-4 bg-gray-50 border-b border-gray-200 rounded-t-lg">
        <div class="space-x-2">
            <button data-modal-target="buku-modal" data-modal-toggle="buku-modal" class="flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none transition-all duration-200 ease-in-out shadow-md transform hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v14m7-7H5" />
                </svg>
                Add Buku
            </button>
        </div>
    </div>

    <div class="px-4 py-2 bg-white rounded-b-lg shadow-sm border-x-2 border-b-2 border-gray-200">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                    <tr>
                        <th scope="col" class="px-6 py-3">Cover</th>
                        <th scope="col" class="px-6 py-3">Judul</th>
                        <th scope="col" class="px-6 py-3">Penulis</th>
                        <th scope="col" class="px-6 py-3">Kode</th>
                        <th scope="col" class="px-6 py-3">Tahun Terbit</th>
                        <th scope="col" class="px-6 py-3">Kategori</th>
                        <th scope="col" class="px-6 py-3">Jumlah</th>
                        <th scope="col" class="px-6 py-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bukus as $buku)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4">
                                @if($buku->foto)
                                    <img src="{{ asset($buku->foto) }}" alt="foto Buku"  class="w-24 h-32 object-cover rounded-lg shadow-md">
                                @endif
                            </td>                                                                               
                            <td class="px-6 py-4">{{ $buku->judul }}</td>
                            <td class="px-6 py-4">{{ $buku->penulis }}</td>
                            <td class="px-6 py-4">{{ $buku->code }}</td>
                            <td class="px-6 py-4">{{ $buku->tahun_terbit }}</td>
                            <td class="px-6 py-4">
                                <div class="flex flex-wrap gap-2">
                                    @foreach($buku->kategori as $kategori)
                                        <span class="px-3 py-1 text-xs font-semibold text-white bg-gradient-to-r from-blue-500 to-blue-600 rounded-full shadow-md">
                                            {{ $kategori->nama_kategori }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>                                                       
                            <td class="px-6 py-4">{{ $buku->jumlah }}</td>
                            <td class="px-6 py-4 flex items-center space-x-2">
                                <button type="button" data-modal-target="detail-modal-{{ $buku->id }}" data-modal-toggle="detail-modal-{{ $buku->id }}" class="p-2 rounded-full border border-blue-500 text-blue-500 hover:bg-blue-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                        <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                        <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z" clip-rule="evenodd" />
                                      </svg>                                      
                                </button>
                                <button type="button" data-modal-target="edit-modal-{{ $buku->id }}" data-modal-toggle="edit-modal-{{ $buku->id }}" class="p-2 rounded-full border border-blue-600 hover:bg-blue-100 text-blue-600 hover:text-blue-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                        <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                                        <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                                    </svg>                                      
                                </button>
                                <button type="button" data-modal-target="delete-modal-{{ $buku->id }}" data-modal-toggle="delete-modal-{{ $buku->id }}" class="p-2 rounded-full border border-red-600 hover:bg-red-100 text-red-600 hover:text-red-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                        <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z" clip-rule="evenodd" />
                                    </svg>                                      
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="px-6 py-4 text-center text-gray-500">Tidak ada data buku</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @include('admin.layouts.pages.buku.tambah')
    @include('admin.layouts.pages.buku.delete')
    @include('admin.layouts.pages.buku.edit')
    @include('admin.layouts.pages.buku.detail')
@endsection
