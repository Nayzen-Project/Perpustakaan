@extends('user.layouts.dashboard')

@section('content')
    <div class="flex justify-center items-center min-h-screen px-4 lg:px-12">
        <div class="bg-white shadow-md rounded-lg overflow-hidden p-6 border w-full max-w-6xl">
            <h2 class="text-3xl font-bold text-center mb-6">Riwayat Peminjaman Saya</h2>

            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 mb-4">
                <div class="w-full md:w-1/2">
                    <form class="flex items-center">
                        <label for="simple-search" class="sr-only">Search</label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2" placeholder="Cari buku..." required>
                        </div>
                    </form>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-700 border border-gray-300 shadow-md">
                    <thead class="text-xs uppercase bg-gray-200">
                        <tr>
                            <th class="px-4 py-3 border text-center whitespace-nowrap">No</th>
                            <th class="px-4 py-3 border whitespace-nowrap">Judul Buku</th>
                            <th class="px-4 py-3 border text-center whitespace-nowrap">Tanggal Peminjaman</th>
                            <th class="px-4 py-3 border text-center whitespace-nowrap">Batas Pengembalian</th>
                            <th class="px-4 py-3 border text-center whitespace-nowrap">Tanggal Dikembalikan</th>
                            <th class="px-4 py-3 border text-center whitespace-nowrap min-w-[150px]">Status</th>
                            <th class="px-4 py-3 border text-center whitespace-nowrap">Denda</th>
                            <th class="px-4 py-3 border text-center whitespace-nowrap">Bukti</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($riwayat_peminjaman as $index => $peminjaman)
                        <tr class="border-b">
                            <td class="px-4 py-3 border text-center">{{ $index + 1 }}</td>
                            <td class="px-4 py-3 border">
                                @foreach ($peminjaman->buku as $buku)
                                    <span class="block">{{ $buku->judul }}</span>
                                @endforeach
                            </td>
                            <td class="px-4 py-3 border text-center">
                                {{ date('d M Y', strtotime($peminjaman->tanggal_peminjaman)) }}
                            </td>
                            <td class="px-4 py-3 border text-center">
                                {{ date('d M Y', strtotime($peminjaman->tanggal_pengembalian)) }}
                            </td>
                            <td class="px-4 py-3 border text-center">
                                {{ $peminjaman->tanggal_dikembalikan ?? 'Belum dikembalikan' }}
                            </td>                            
                            <td class="px-4 py-3 border text-center">
                                @php
                                    $statusColors = [
                                        'dipinjam' => 'bg-yellow-500',
                                        'dikembalikan' => 'bg-green-500',
                                        'menunggu pengambilan' => 'bg-blue-500',
                                        'telat dikembalikan' => 'bg-red-500',
                                    ];
                                @endphp
                                <div class="flex justify-center">
                                    <span class="px-3 py-1 rounded-full text-white text-sm font-semibold {{ $statusColors[$peminjaman->status] ?? 'bg-gray-500' }}">
                                        {{ ucfirst($peminjaman->status) }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-4 py-3 border text-center">
                                <span class="text-{{ ($peminjaman->denda && $peminjaman->denda->nominal > 0) ? 'red' : 'green' }}-500 font-semibold">
                                    Rp {{ number_format($peminjaman->denda->nominal ?? 0, 0, ',', '.') }}
                                </span>
                            </td>                                                       
                            <td class="px-4 py-3 border text-center">
                                <a href="{{ route('user.peminjaman.bukti', $peminjaman)}}" class="text-blue-500 hover:underline font-medium">Lihat Bukti</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-gray-500">Belum ada riwayat peminjaman.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="flex justify-between items-center mt-4">
                <a href="{{ $riwayat_peminjaman->previousPageUrl() }}" 
                   class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 {{ $riwayat_peminjaman->onFirstPage() ? 'pointer-events-none opacity-50' : '' }}">
                    Prev
                </a>
                
                <span class="px-4 py-2 bg-gray-100 text-gray-700 rounded">
                    Halaman {{ $riwayat_peminjaman->currentPage() }} dari {{ $riwayat_peminjaman->lastPage() }}
                </span>
                
                <a href="{{ $riwayat_peminjaman->nextPageUrl() }}" 
                   class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 {{ $riwayat_peminjaman->hasMorePages() ? '' : 'pointer-events-none opacity-50' }}">
                    Next
                </a>
            </div>
        </div>
    </div>
@endsection
