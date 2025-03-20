@foreach($bukus as $buku)
    <div id="detail-modal-{{ $buku->id }}" tabindex="-1" aria-hidden="true" class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-black bg-opacity-40">
        <div class="relative w-full max-w-md bg-white rounded-lg shadow-lg">
            <!-- Modal Header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">
                    Detail Buku
                </h3>
                <button type="button" class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg p-2" data-modal-toggle="detail-modal-{{ $buku->id }}" aria-label="Close modal">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-4 space-y-4 max-h-[80vh] overflow-y-auto">
                <!-- Book Cover & Title -->
                <div class="flex flex-col md:flex-row items-center justify-center space-y-4 md:space-y-0 md:space-x-8 mb-6">
                    <!-- Book Cover Image -->
                    <div class="w-32 h-48 overflow-hidden rounded-lg shadow-md">
                        @if($buku->foto)
                            <img src="{{ asset($buku->foto) }}" alt="Cover Buku" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gray-200 rounded-lg"></div>
                        @endif
                    </div>

                    <!-- Book Details -->
                    <div class="text-center md:text-left">
                        <h2 class="text-xl font-semibold text-gray-900">{{ $buku->judul }}</h2>
                        <p class="text-gray-600 text-sm">{{ $buku->penulis }}</p>
                        <p class="text-gray-500 text-xs italic">{{ $buku->penerbit }}</p>
                    </div>
                </div>

                <!-- Book Detail Table -->
                <table class="min-w-full table-auto border-collapse">
                    <thead>
                        <tr class="bg-gray-100 text-left">
                            <th class="px-4 py-2 font-medium text-gray-600">Detail</th>
                            <th class="px-4 py-2 font-medium text-gray-600">Informasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Description -->
                        <tr class="border-t">
                            <td class="px-4 py-2 font-semibold text-gray-800">Deskripsi</td>
                            <td class="px-4 py-2 text-gray-700">{{ $buku->description ?? 'Tidak ada deskripsi' }}</td>
                        </tr>

                        <!-- Code -->
                        <tr>
                            <td class="px-4 py-2 font-semibold text-gray-800">Kode</td>
                            <td class="px-4 py-2 text-gray-700">{{ $buku->code }}</td>
                        </tr>

                        <!-- Publication Year -->
                        <tr>
                            <td class="px-4 py-2 font-semibold text-gray-800">Tahun Terbit</td>
                            <td class="px-4 py-2 text-gray-700">{{ $buku->tahun_terbit }}</td>
                        </tr>

                        <!-- Categories -->
                        <tr>
                            <td class="px-4 py-2 font-semibold text-gray-800">Kategori</td>
                            <td class="px-4 py-2 text-gray-700">
                                <div class="flex flex-wrap gap-2">
                                    @foreach($buku->kategori as $kategori)
                                        <span class="px-3 py-1 text-xs font-semibold text-white bg-gradient-to-r from-blue-500 to-blue-600 rounded-full shadow-md">
                                            {{ $kategori->nama_kategori }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                        </tr>

                        <!-- Quantity Available -->
                        <tr>
                            <td class="px-4 py-2 font-semibold text-gray-800">Jumlah</td>
                            <td class="px-4 py-2 text-gray-700">{{ $buku->jumlah }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endforeach
