@extends('admin.layouts.dashboard')

@section('title', $title)

@section('content')
@vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- <div class="flex justify-between items-center p-4 bg-gray-50 border-b border-gray-200 rounded-t-lg">
        <div class="space-x-2">
            <button data-modal-target="pm-modal" data-modal-toggle="pm-modal" class="flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none transition-all duration-200 ease-in-out shadow-md transform hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v14m7-7H5" />
                </svg>
                Add Peminjam
            </button>
        </div>
    </div> --}}

    <div class="px-4 py-2 bg-white rounded-b-lg shadow-sm border-x-2 border-b-2 border-gray-200">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                    <tr>
                        <th scope="col" class="px-6 py-3">NO</th>
                        <th scope="col" class="px-6 py-3">Photo</th>
                        <th scope="col" class="px-6 py-3">Nama Lengkap</th>
                        <th scope="col" class="px-6 py-3">User Id</th>
                        <th scope="col" class="px-6 py-3">Email</th>
                        <th scope="col" class="px-6 py-3">Location</th>
                        <th scope="col" class="px-6 py-3">Alamat</th>
                        <th scope="col" class="px-6 py-3">Phone</th>
                        <th scope="col" class="px-6 py-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($peminjams as $peminjam)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $peminjam->id }}</td>
                            <td class="px-6 py-4">
                                <img src="https://api.dicebear.com/9.x/identicon/svg?seed={{ Auth::user()->id }}" alt="Avatar" class="w-10 h-10 rounded-full">
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $peminjam->nama_lengkap }}</td>
                            <td class="px-6 py-4">{{ $peminjam->user->id }}</td>
                            <td class="px-6 py-4">{{ $peminjam->user->email }}</td>
                            <td class="px-6 py-4">
                                {{ $peminjam->location['provinsi'] ?? 'N/A' }},
                                {{ $peminjam->location['kabupaten'] ?? 'N/A' }},
                                {{ $peminjam->location['kecamatan'] ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4">{{ $peminjam->alamat }}</td>
                            <td class="px-6 py-4">{{ $peminjam->phone }}</td>
                            <td class="px-6 py-4 flex items-center space-x-2">
                                <button type="button" data-modal-target="edit-modal-{{ $peminjam->id }}" data-modal-toggle="edit-modal-{{ $peminjam->id }}" class="p-2 rounded-full border border-blue-600 hover:bg-blue-100 text-blue-600 hover:text-blue-700">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                    <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                                    <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                                </svg>                                      
                                </button>
                        
                                <button type="button" data-modal-target="delete-modal-{{ $peminjam->id }}" data-modal-toggle="delete-modal-{{ $peminjam->id }}" class="p-2 rounded-full border border-red-600 hover:bg-red-100 text-red-600 hover:text-red-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                        <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z" clip-rule="evenodd" />
                                    </svg>                                      
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-4 text-center text-gray-500">No members found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    {{-- @include('admin.layouts.pages.peminjam.tambah') --}}
    @include('admin.layouts.pages.peminjam.delete')
    @include('admin.layouts.pages.peminjam.edit')
@endsection
