@foreach ($peminjamen as $item)
<div id="edit-modal-{{ $item->id }}" class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-black bg-opacity-40">
    <div class="relative p-4 w-full max-w-lg max-h-full">
        <div class="relative bg-white rounded-lg shadow-lg h-full">
            <!-- Modal Header -->
            <div class="flex items-center justify-between p-4 border-b rounded-t border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Edit Peminjaman</h3>
                <button type="button" class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center" data-modal-toggle="edit-modal-{{ $item->id }}">
                    <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <!-- Form Edit -->
            <form action="{{ route('petugas.peminjaman.update', $item->id) }}" method="POST" class="p-6 space-y-6 max-h-[80vh] overflow-y-auto">
                @csrf
                @method('PUT')

                <!-- Tanggal Peminjaman -->
                <div class="space-y-1">
                    <label for="tanggal_peminjaman" class="block text-sm font-medium text-gray-700">Tanggal Peminjaman</label>
                    <input type="date" name="tanggal_peminjaman" value="{{ old('tanggal_peminjaman', $item->tanggal_peminjaman) }}" class="w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                </div>

                <!-- Tanggal Pengembalian -->
                <div class="space-y-1">
                    <label for="tanggal_pengembalian" class="block text-sm font-medium text-gray-700">Tanggal Pengembalian</label>
                    <input type="date" name="tanggal_pengembalian" value="{{ old('tanggal_pengembalian', $item->tanggal_pengembalian) }}" class="w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                </div>

                <!-- Tanggal Dikembalikan -->
                <div class="space-y-1">
                    <label for="tanggal_dikembalikan" class="block text-sm font-medium text-gray-700">Tanggal Dikembalikan</label>
                    <input type="date" name="tanggal_dikembalikan" value="{{ old('tanggal_dikembalikan', $item->tanggal_dikembalikan) }}" class="w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Status -->
                <div class="space-y-1">
                    <label for="status" class="block text-sm font-medium text-gray-700">Status Peminjaman</label>
                    <select name="status" class="w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="dipinjam" @if($item->status == 'dipinjam') selected @endif>Dipinjam</option>
                        <option value="dikembalikan" @if($item->status == 'dikembalikan') selected @endif>Dikembalikan</option>
                        <option value="menunggu pengambilan" @if($item->status == 'menunggu pengambilan') selected @endif>Menunggu Pengambilan</option>
                        <option value="telat dikembalikan" @if($item->status == 'telat dikembalikan') selected @endif>Telat Dikembalikan</option>
                    </select>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
