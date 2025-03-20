@extends('admin.layouts.dashboard')

@section('title', $title)

@section('content')
@vite(['resources/css/app.css', 'resources/js/app.js'])
    <div class="flex justify-between items-center p-4 bg-gray-50 border-b border-gray-200 rounded-t-lg">
        <div class="space-x-2">
        </div>
    </div>

    <div class="px-4 py-2 bg-white rounded-b-lg shadow-sm border-x-2 border-b-2 border-gray-200">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                    <tr>
                        <th scope="col" class="px-6 py-3">Photo</th>
                        <th scope="col" class="px-6 py-3">Nama</th>
                        <th scope="col" class="px-6 py-3">Email</th>
                        <th scope="col" class="px-6 py-3">Role</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <img src="https://api.dicebear.com/9.x/identicon/svg?seed={{ Auth::user()->id }}" alt="Avatar" class="w-10 h-10 rounded-full">
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $user->name }}</td>
                            <td class="px-6 py-4">{{ $user->email}}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-xs font-medium 
                                    {{ $user->role == 'user' ? 'text-blue-600 bg-blue-200' : '' }} rounded-lg">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if ($user->is_confirmed)
                                    <span class="px-2 py-1 text-xs font-medium text-green-600 bg-green-200 rounded-lg">Confirmed</span>
                                @else
                                    <span class="px-2 py-1 text-xs font-medium text-red-600 bg-red-200 rounded-lg">Pending</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if (!$user->is_confirmed)
                                    <form action="{{ route('admin.confirm-user', $user->id) }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="px-4 py-2 text-white bg-green-600 hover:bg-green-700 rounded-lg">Confirm</button>
                                    </form>
                                @endif
                            </td>                            
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-4 text-center text-gray-500">No user found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

