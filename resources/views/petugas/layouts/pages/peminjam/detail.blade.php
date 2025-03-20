<!-- Modal Detail Peminjam -->
@foreach($peminjams as $peminjam)
    <div id="detail-modal-{{ $peminjam->id }}" tabindex="-1" aria-hidden="true" class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-black bg-opacity-40">
        <div class="relative p-4 w-full max-w-lg max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-lg h-full">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Detail Peminjam
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="detail-modal-{{ $peminjam->id }}">
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
                            @if($peminjam && $peminjam->photo)
                                <img src="{{ asset('storage/' . $peminjam->photo) }}"
                                     alt="User Avatar"
                                     class="w-28 h-28 rounded-full border border-gray-300 object-cover">
                            @else
                                <img src="https://api.dicebear.com/9.x/identicon/svg?seed={{ Auth::user()->id }}"
                                     alt="User Avatar"
                                     class="w-28 h-28 rounded-full border border-gray-300 object-cover">
                            @endif
                            <h2 class="mt-4 text-lg font-semibold text-gray-900">{{ $peminjam->nama_lengkap }}</h2>
                            <p class="text-gray-600 text-sm">{{ $peminjam->user->email }}</p>
                        </div>
                    </div>

                    <!-- Tabel Detail Peminjam -->
                    <table class="min-w-full table-auto">
                        <thead>
                            <tr class="bg-gray-100 text-left">
                                <th class="px-4 py-2 font-medium text-gray-600">Field</th>
                                <th class="px-4 py-2 font-medium text-gray-600">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Nama Lengkap -->
                            <tr>
                                <td class="px-4 py-2 font-semibold text-gray-800">Nama Lengkap</td>
                                <td class="px-4 py-2 text-gray-700">{{ $peminjam->nama_lengkap }}</td>
                            </tr>

                            <!-- User ID -->
                            <tr>
                                <td class="px-4 py-2 font-semibold text-gray-800">User ID</td>
                                <td class="px-4 py-2 text-gray-700">{{ $peminjam->user->id }}</td>
                            </tr>

                            <!-- Email -->
                            <tr>
                                <td class="px-4 py-2 font-semibold text-gray-800">Email</td>
                                <td class="px-4 py-2 text-gray-700">{{ $peminjam->user->email }}</td>
                            </tr>

                            <!-- Location Fields -->
                            <tr>
                                <td class="px-4 py-2 font-semibold text-gray-800">Location</td>
                                <td class="px-4 py-2 text-gray-700">
                                    {{ $peminjam->location['provinsi'] ?? 'N/A' }},
                                    {{ $peminjam->location['kabupaten'] ?? 'N/A' }},
                                    {{ $peminjam->location['kecamatan'] ?? 'N/A' }}
                                </td>
                            </tr>

                            <!-- Address -->
                            <tr>
                                <td class="px-4 py-2 font-semibold text-gray-800">Alamat</td>
                                <td class="px-4 py-2 text-gray-700">{{ $peminjam->alamat }}</td>
                            </tr>

                            <!-- Phone -->
                            <tr>
                                <td class="px-4 py-2 font-semibold text-gray-800">Phone</td>
                                <td class="px-4 py-2 text-gray-700">{{ $peminjam->phone }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endforeach
