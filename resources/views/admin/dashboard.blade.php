@extends('admin.layouts.dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <!-- Card 1 -->
    <div class="bg-white shadow-lg rounded-xl p-6 flex items-center space-x-4">
        <div class="p-3 bg-blue-700 text-white rounded-full">
            <i class="fas fa-users-cog text-xl"></i>
        </div>
        <div>
            <h3 class="text-gray-700 text-lg font-semibold">Total User</h3>
            <p class="text-2xl font-bold text-gray-900">{{ $totalusers }}</p>
        </div>
    </div>

    <!-- Card 2 -->
    <div class="bg-white shadow-lg rounded-xl p-6 flex items-center space-x-4">
        <div class="p-3 bg-green-500 text-white rounded-full">
            <i class="fas fa-users text-xl"></i>
        </div>
        <div>
            <h3 class="text-gray-700 text-lg font-semibold">Total Peminjam</h3>
            <p class="text-2xl font-bold text-gray-900">{{ $totalpeminjams }}</p>
        </div>
    </div>

    <!-- Card 3 -->
    <div class="bg-white shadow-lg rounded-xl p-6 flex items-center space-x-4">
        <div class="p-3 bg-yellow-500 text-white rounded-full">
            <i class="fas fa-user-tie text-xl"></i>
        </div>
        <div>
            <h3 class="text-gray-700 text-lg font-semibold">Total Petugas</h3>
            <p class="text-2xl font-bold text-gray-900">{{ $totalpetugas }}</p>
        </div>
    </div>

    <!-- Card 4 -->
    <div class="bg-white shadow-lg rounded-xl p-6 flex items-center space-x-4">
        <div class="p-3 bg-red-500 text-white rounded-full">
            <i class="fas fa-book text-xl"></i>
        </div>
        <div>
            <h3 class="text-gray-700 text-lg font-semibold">Total Peminjaman</h3>
            <p class="text-2xl font-bold text-gray-900">{{ $totalpeminjamen }}</p>
        </div>
    </div>

    <!-- Card 4 -->
    <div class="bg-white shadow-lg rounded-xl p-6 flex items-center space-x-4">
        <div class="p-3 bg-red-500 text-white rounded-full">
            <i class="fas fa-money-bill-alt text-xl"></i>
        </div>
        <div>
            <h3 class="text-gray-700 text-lg font-semibold">Total Denda</h3>
            <p class="text-2xl font-bold text-gray-900">{{ $totaldendas }}</p>
        </div>
    </div>
</div>
{{-- 
<div class="mt-6">
<div class="flex justify-between items-center p-4 bg-gray-50 border-b border-gray-200 rounded-t-lg">
    <div class="space-x-2">
        <button data-modal-target="user-modal" data-modal-toggle="user-modal" 
            class="flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none transition-all duration-200 ease-in-out shadow-md transform hover:scale-105">
            
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v14m7-7H5" />
            </svg>
            
            Add User
        </button>
    </div>
</div>

<div class="px-4 py-2 bg-white rounded-b-lg shadow-sm border-x-2 border-b-2 border-gray-200">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-100">
            <tr>
                <th scope="col" class="px-6 py-3">Id</th>
                <th scope="col" class="px-6 py-3">Name</th>
                <th scope="col" class="px-6 py-3">Email</th>
                <th scope="col" class="px-6 py-3">Role</th>
                <th scope="col" class="px-6 py-3">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="px-6 py-4 font-medium text-gray-900">{{  $user->id }}</td>
                    <td class="px-6 py-4">{{ $user->name }}</td>
                    <td class="px-6 py-4">{{ $user->email }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs font-medium 
                            {{ $user->role == 'petugas' ? 'text-blue-600 bg-blue-200' : 
                                ($user->role == 'user' ? 'text-green-600 bg-green-200' : 
                                ($user->role == 'admin' ? 'text-red-600 bg-red-200' : 'text-gray-600 bg-gray-200')) }} rounded-lg">
                            {{ $user->role }}
                        </span>
                    </td>
                    <td class="px-6 py-4 flex items-center space-x-2">
                        <button data-modal-target="popup-modal-user{{ $user->id }}" data-modal-toggle="popup-modal-user{{ $user->id }}" 
                            class="w-10 h-10 flex justify-center items-center rounded-full bg-blue-600 hover:bg-blue-500 focus:outline-none shadow-md transform transition-all duration-200 ease-in-out hover:scale-110 active:scale-95">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-2 14H7L5 7M15 7V4a3 3 0 00-3-3h-2a3 3 0 00-3 3v3m6 0H9" />
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
@include('admin.tambah-user')
@include('admin.delete-user') --}}
@endsection
