<!-- Modal Edit Denda -->
@foreach ($dendas as $denda)
<div id="edit-modal-{{ $denda->id }}" class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-black bg-opacity-40">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow-lg h-full">
            <!-- Modal Header -->
            <div class="flex items-center justify-between p-4 border-b rounded-t border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Edit Denda</h3>
                <button type="button" class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center" data-modal-toggle="edit-modal-{{ $denda->id }}">
                    <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Form Edit Denda -->
            <form action="{{ route('petugas.denda.update', $denda->id) }}" method="POST" class="p-4 space-y-4 max-h-[80vh] overflow-y-auto">
                @csrf
                @method('PUT')

                <div>
                <label for="peminjaman_id">Peminjaman ID</label>
                <input type="text" name="peminjaman_id" value="{{ $denda->peminjaman_id }}" readonly class="input-field" />
                </div>
                
                <!-- Nominal Denda -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nominal Denda</label>
                    <input type="number" name="nominal" value="{{ old('nominal', $denda->nominal) }}" class="input-field" required>
                </div>

                <!-- Status Pembayaran -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Status Pembayaran</label>
                    <select name="status" class="input-field" required>
                        <option value="belum dibayar" @if($denda->status == 'belum dibayar') selected @endif>Belum Dibayar</option>
                        <option value="dibayar" @if($denda->status == 'dibayar') selected @endif>Dibayar</option>
                    </select>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Update Denda
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
