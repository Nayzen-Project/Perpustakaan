@extends('user.layouts.dashboard')

@section('content')
    <main class="flex flex-1 p-6 space-x-6">
        <div class="w-full h-full">
            <!-- Welcome Message -->
            <div class="bg-white p-4 rounded-lg shadow-md mb-4 relative">
                <h1 class="text-2xl font-bold">Hello, {{ Auth::user()->name }}!</h1>
                <p class="text-gray-600 text-sm">Welcome</p>
                
                <!-- Avatar dan Settings Dropdown -->
                <div class="absolute top-4 right-6 flex items-center space-x-4">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <!-- Avatar -->
                                <img src="https://api.dicebear.com/9.x/identicon/svg?seed={{ Auth::user()->id }}" alt="User Avatar" class="w-8 h-8 rounded-full object-cover">
                                <div class="ms-2 text-sm hidden sm:block">{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('user.profile.index')">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="bg-white shadow-lg rounded-lg p-6">
                <section class="flex-1">
                    <!-- Header Panel -->
                    <div class="flex justify-between items-center mb-4">
                        <h1 class="text-2xl font-bold">📚 Explore Buku</h1>

                        <!-- Search Bar -->
                        <form action="{{ route('user.search') }}" method="GET" class="relative w-1/3">
                            <input 
                                type="text" name="q" value="{{ request('q') }}" 
                                class="w-full py-2 pl-10 pr-10 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500" 
                                placeholder="Cari Buku..."
                            />
                            <button type="submit" class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5ZM2.25 10.5a8.25 8.25 0 1 1 14.59 5.28l4.69 4.69a.75.75 0 1 1-1.06 1.06l-4.69-4.69A8.25 8.25 0 0 1 2.25 10.5Z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            @if(request('q'))
                                <a href="{{ route('user.dashboard') }}" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-red-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                        <path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 0 1 1.06 0L12 10.94l5.47-5.47a.75.75 0 1 1 1.06 1.06L13.06 12l5.47 5.47a.75.75 0 1 1-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 0 1-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                                      </svg>                                      
                                </a>
                            @endif
                        </form>
                    </div>

                    <!-- Hasil Pencarian -->
                    @if(request('q'))
                        <div class="p-4 bg-gray-100 rounded-lg mb-3">
                            <h3 class="text-xl font-semibold mb-3">Hasil Pencarian untuk: "{{ request('q') }}"</h3>
                            
                            @if($bukus->isEmpty())
                                <p class="text-gray-500">📖 Buku tidak ditemukan.</p>
                            @else
                                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4">
                                    @foreach($bukus as $buku)
                                        <div class="relative bg-white shadow-md rounded-lg overflow-hidden transform transition duration-300 hover:scale-105 group max-w-[170px] mx-auto">
                                            <div class="w-full aspect-[3/4] overflow-hidden">
                                                <img src="{{ asset($buku->foto) }}" alt="{{ $buku->judul }}" 
                                                    class="w-full h-full object-cover">
                                            </div>
                                            <div class="absolute bottom-0 left-0 w-full bg-white p-3 shadow-lg transform translate-y-full group-hover:translate-y-0 transition-transform duration-300 ease-in-out">
                                                <p class="text-gray-600 text-sm text-center">
                                                    <span class="font-bold">{{$buku->judul}}</span>
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>                      
                            @endif
                        </div>
                    @endif

                    <!-- Recommended Section -->
                    @if(!request('q'))
                        <div class="p-4 bg-gray-100 rounded-lg mb-6">
                            <div class="flex justify-between items-center mb-3">
                                <h3 class="font-semibold">Recommended</h3>
                            </div>

                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4">
                                @forelse($recommendedBooks as $buku)
                                <div class="relative bg-white shadow-md rounded-lg overflow-hidden transform transition duration-300 hover:scale-105 group max-w-[170px] mx-auto">
                                
                                    <div class="w-full aspect-[3/4] overflow-hidden">
                                        <img src="{{ asset($buku->foto) }}" alt="{{ $buku->judul }}" 
                                            class="w-full h-full object-cover">
                                    </div>
                            
                                    <div class="absolute bottom-0 left-0 w-full bg-white p-3 shadow-lg transform translate-y-full group-hover:translate-y-0 transition-transform duration-300 ease-in-out">
                                        <p class="text-gray-600 text-sm text-center">
                                            <span class="font-bold">{{$buku->judul}}</span>
                                        </p>
                                    </div>
                                </div>
                                @empty
                                    <div class="col-span-4 text-center text-gray-500">
                                        📖 Tidak ada buku dalam rekomendasi.
                                    </div>
                                @endforelse
                            </div>                      
                        </div>
                    @endif

                    <!-- Categories Section -->
                    @if(!request('q'))
                        <div class="p-4 bg-gray-100 rounded-lg" x-data="{ selectedCategory: 'All' }">
                            <div class="flex justify-between items-center mb-3">
                                <h3 class="font-semibold">Categories</h3>
                            </div>

                            <!-- Filter Kategori -->
                            <div class="flex space-x-2 mb-6">
                                <button 
                                    class="px-4 py-2 text-sm rounded-full hover:bg-blue-600"
                                    :class="selectedCategory === 'All' ? 'bg-blue-500 text-white' : 'border border-gray-300'"
                                    @click="selectedCategory = 'All'">
                                    All
                                </button>

                                @foreach ($kategoris as $kategori)
                                    <button 
                                        class="px-4 py-2 text-sm rounded-full hover:bg-blue-600"
                                        :class="selectedCategory === '{{ $kategori->nama_kategori }}' ? 'bg-blue-500 text-white' : 'border border-gray-300'"
                                        @click="selectedCategory = '{{ $kategori->nama_kategori }}'">
                                        {{ $kategori->nama_kategori }}
                                    </button>
                                @endforeach
                            </div>

                           <!-- Grid Buku -->
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4">
                                @forelse($bukus as $buku)
                                    <div 
                                        class="relative bg-white shadow-md rounded-lg overflow-hidden transform transition duration-300 hover:scale-105 group max-w-[170px] mx-auto"
                                        x-show="selectedCategory === 'All' || {{ json_encode($buku->kategori->pluck('nama_kategori')->toArray()) }}.includes(selectedCategory)">
                                        
                                        <div class="w-full aspect-[3/4] overflow-hidden">
                                            <img src="{{ asset($buku->foto) }}" alt="{{ $buku->judul }}" 
                                                class="w-full h-full object-cover">
                                        </div>

                                        <div class="absolute bottom-0 left-0 w-full bg-white p-3 shadow-lg transform translate-y-full group-hover:translate-y-0 transition-transform duration-300 ease-in-out">
                                            <p class="text-gray-600 text-sm text-center">
                                                <span class="font-bold">{{$buku->judul}}</span>
                                            </p>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-span-4 text-center text-gray-500">
                                        📖 Tidak ada buku dalam kategori ini.
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    @endif
                </section>
            </div> 
        </div>
    </main>
@endsection
