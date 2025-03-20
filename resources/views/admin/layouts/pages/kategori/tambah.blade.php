<!-- Modal Add New Kategori -->
<div id="kategori-modal" tabindex="-1" aria-hidden="true" class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-black bg-opacity-40">
    <div class="relative w-full max-w-md bg-white rounded-lg shadow-lg">
        <!-- Modal Header -->
        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">
                Add New Kategori
            </h3>
            <button type="button" class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg p-2" data-modal-toggle="kategori-modal" aria-label="Close modal">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Modal Body -->
        <form action="{{ route('admin.kategori.store') }}" method="POST" enctype="multipart/form-data" class="p-4 space-y-4 max-h-[80vh] overflow-y-auto">
            @csrf
            <!-- Nama Kategori -->
            <div>
                <label for="nama_kategori" class="block text-sm font-medium text-gray-800">Nama Kategori Buku</label>
                <input type="text" name="nama_kategori" id="nama_kategori" class="block w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="Masukkan nama kategori" required>
            </div>

            <!-- Kode Buku -->
            <div>
                <label class="block text-sm font-medium text-gray-800">Kode Buku</label>
                <p id="kode" class="text-sm font-semibold text-blue-600">Kode akan dibuat otomatis...</p>
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
<script>
    document.getElementById('nama_kategori').addEventListener('input', function () {
        let namaKategori = this.value.trim();
        let kode = namaKategori.split(' ') // Pisahkan setiap kata
            .map(word => word.charAt(0).toUpperCase()) // Ambil huruf pertama dan ubah ke uppercase
            .join(''); // Gabungkan hasilnya tanpa spasi

        document.getElementById('kode').value = kode; // Isi field kode otomatis
    });
</script>

