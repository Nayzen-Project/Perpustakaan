<!-- Modal Add New Buku -->
<div id="buku-modal" tabindex="-1" aria-hidden="true" class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-black bg-opacity-40">
    <div class="relative w-full max-w-md bg-white rounded-lg shadow-lg">
          <!-- Modal Header -->
        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">
                Create New Buku
            </h3>
            <button type="button" class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg p-2" data-modal-toggle="buku-modal" aria-label="Close modal">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Modal Body -->
        <form action="{{ route('admin.buku.store') }}" method="POST" enctype="multipart/form-data" class="p-4 space-y-4 max-h-[80vh] overflow-y-auto">
            @csrf

            <!-- Judul -->
            <div>
                <label for="judul" class="block text-sm font-medium text-gray-800">Judul Buku</label>
                <input type="text" name="judul" id="judul" class="block w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="Masukkan judul buku" required>
            </div>

            <!-- Penulis -->
            <div>
                <label for="penulis" class="block text-sm font-medium text-gray-800">Penulis</label>
                <input type="text" name="penulis" id="penulis" class="block w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="Masukkan nama penulis" required>
            </div>

            <!-- Penerbit -->
            <div>
                <label for="penerbit" class="block text-sm font-medium text-gray-800">Penerbit</label>
                <input type="text" name="penerbit" id="penerbit" class="block w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="Masukkan penerbit" required>
            </div>

            <!-- Deskripsi -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-800">Deskripsi</label>
                <textarea name="description" id="description" rows="3" class="block w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="Masukkan deskripsi buku"></textarea>
            </div>

            <!-- Tahun Terbit -->
            <div>
                <label for="tahun_terbit" class="block text-sm font-medium text-gray-800">Tahun Terbit</label>
                <input type="number" name="tahun_terbit" id="tahun_terbit" class="block w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" min="1000" max="{{ date('Y') }}" placeholder="Masukkan tahun terbit" required>
            </div>

           <!-- Kategori -->
            <select id="kategori" name="kategori[]" multiple class="choices-multiple">
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" data-code="{{ $kategori->kode }}">{{ $kategori->nama_kategori }}</option>
                @endforeach
            </select>
            
            <!-- Kode Buku -->
            <div>
                <label class="block text-sm font-medium text-gray-800">Kode Buku</label>
                <p id="kode-buku-preview" class="text-sm font-semibold text-blue-600">Kode akan dibuat otomatis...</p>
            </div>
            
            <!-- Jumlah Buku -->
            <div>
                <label for="jumlah" class="block text-sm font-medium text-gray-800">Jumlah Buku</label>
                <input type="number" name="jumlah" id="jumlah" class="block w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" min="1" placeholder="Masukkan jumlah buku" required>
            </div>

            <!-- Upload Foto -->
            <div>
                <label for="foto" class="block text-sm font-medium text-gray-800">Upload Foto</label>
                <input type="file" name="foto" id="foto" accept="image/*"
                    class="block w-full py-3 px-4 text-sm border border-gray-300 rounded-lg cursor-pointer focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300">
                    Create
                </button>
            </div>
        </form>
    </div>
    </div>
</div>

<!-- Choices.js JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const kategoriSelect = new Choices('#kategori', {
            removeItemButton: true, // Bisa menghapus pilihan
            searchEnabled: true, // Ada fitur pencarian
            placeholderValue: "Pilih kategori...", // Placeholder
        });
    
        // Update kode buku saat memilih kategori
        document.getElementById('kategori').addEventListener('change', generateCode);

    });
</script>
    