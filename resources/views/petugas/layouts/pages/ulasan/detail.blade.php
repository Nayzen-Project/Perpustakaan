@foreach($ulasans as $ulasan)
    <div id="detail-modal-{{ $ulasan->id }}" tabindex="-1" aria-hidden="true" class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-black bg-opacity-40">
        <div class="relative p-4 w-full max-w-lg max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-lg h-full">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Detail Ulasan Buku
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="detail-modal-{{ $ulasan->id }}">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="p-4 max-h-[80vh] overflow-y-auto">
                    <!-- Profile Section -->
                    <div class="flex flex-col items-center space-y-6 mb-6">
                        <!-- Profile Image -->
                        <div class="flex flex-col items-center w-full">
                            @if($ulasan->buku && $ulasan->buku->foto)
                                <img src="{{ asset( $ulasan->buku->foto) }}"
                                     alt="Cover Buku"
                                     class="w-28 h-28 rounded-lg border border-gray-300 object-cover">
                            @else
                                <img src="https://via.placeholder.com/150"
                                     alt="Cover Buku"
                                     class="w-28 h-28 rounded-lg border border-gray-300 object-cover">
                            @endif
                            <h2 class="mt-4 text-lg font-semibold text-gray-900">{{ $ulasan->buku->judul }}</h2>
                            <p class="text-gray-600 text-sm">ID Buku: {{ $ulasan->buku->id }}</p>
                        </div>
                    </div>

                    <!-- Tabel Detail Ulasan -->
                    <table class="min-w-full table-auto">
                        <thead>
                            <tr class="bg-gray-100 text-left">
                                <th class="px-4 py-2 font-medium text-gray-600">Field</th>
                                <th class="px-4 py-2 font-medium text-gray-600">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Nama Peminjam -->
                            <tr>
                                <td class="px-4 py-2 font-semibold text-gray-800">Nama Peminjam</td>
                                <td class="px-4 py-2 text-gray-700">{{ $ulasan->peminjam->nama_lengkap }}</td>
                            </tr>

                            <!-- Ulasan -->
                            <tr>
                                <td class="px-4 py-2 font-semibold text-gray-800">Ulasan</td>
                                <td class="px-4 py-2 text-gray-700">{{ $ulasan->ulasan }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endforeach
