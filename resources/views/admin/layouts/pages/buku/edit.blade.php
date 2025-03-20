@foreach ($bukus as $buku)
<div id="edit-modal-{{ $buku->id }}" tabindex="-1" aria-hidden="true" class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-black bg-opacity-40">
    <div class="relative w-full max-w-md bg-white rounded-lg shadow-lg">
        <!-- Modal Header -->
        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">
                Edit Buku
            </h3>
            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="edit-modal-{{ $buku->id }}">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>

        <!-- Modal Body -->
        <form action="{{ route('admin.buku.update', $buku->id) }}" method="POST" enctype="multipart/form-data" class="p-4 space-y-4 max-h-[80vh] overflow-y-auto">
            @csrf
            @method('PUT')

            <!-- Preview Gambar -->
            <div class="flex justify-center">
                <img id="preview-{{ $buku->id }}" src="{{ $buku->foto ? asset($buku->foto) : asset('storage/default-book.jpg') }}" 
                    alt="Preview Gambar Buku" class="w-32 h-32 object-cover rounded-lg shadow-md">
            </div>

            <!-- Upload Foto -->
            <div>
                <label for="foto-{{ $buku->id }}" class="block text-sm font-medium text-gray-700">Upload Gambar Baru</label>
                <input type="file" name="foto" id="foto-{{ $buku->id }}" accept="image/*" 
                    class="block w-full text-sm border border-gray-300 rounded-lg p-2">
            </div>

            <!-- Judul -->
            <div>
                <label for="judul" class="block text-sm font-medium text-gray-700">Judul</label>
                <input type="text" name="judul" id="judul" value="{{ old('judul', $buku->judul) }}" 
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2" required>
            </div>

            <!-- Penulis -->
            <div>
                <label for="penulis" class="block text-sm font-medium text-gray-700">Penulis</label>
                <input type="text" name="penulis" id="penulis" value="{{ old('penulis', $buku->penulis) }}" 
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2" required>
            </div>

            <!-- Penerbit -->
            <div>
                <label for="penerbit" class="block text-sm font-medium text-gray-700">Penerbit</label>
                <input type="text" name="penerbit" id="penerbit" value="{{ old('penerbit', $buku->penerbit) }}" 
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2" required>
            </div>

            <!-- Deskripsi -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea name="description" id="description" rows="3"
                    class="block w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">{{ old('description', $buku->description) }}</textarea>
            </div>

            <!-- Tahun Terbit -->
            <div>
                <label for="tahun_terbit" class="block text-sm font-medium text-gray-700">Tahun Terbit</label>
                <input type="number" name="tahun_terbit" id="tahun_terbit" value="{{ old('tahun_terbit', $buku->tahun_terbit) }}" 
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2" required>
            </div>

            <!-- Jumlah Buku -->
            <div>
                <label for="jumlah" class="block text-sm font-medium text-gray-700">Jumlah Buku</label>
                <input type="number" name="jumlah" id="jumlah" value="{{ old('jumlah', $buku->jumlah) }}" 
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2" required>
            </div>

             <!-- Kategori Buku dengan Choices.js -->
             <div>
                <label for="kategori-{{ $buku->id }}" class="block text-sm font-medium text-gray-700">Kategori</label>
                <select name="kategori[]" id="kategori-{{ $buku->id }}" multiple class="choices-multiple bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2">
                    @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" 
                            {{ in_array($kategori->id, $buku->kategori->pluck('id')->toArray()) ? 'selected' : '' }}>
                            {{ $kategori->nama_kategori}}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Tambahkan Script Choices.js -->
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        new Choices("#kategori-{{ $buku->id }}", {
            removeItemButton: true,
            searchEnabled: true,
            placeholderValue: "Pilih kategori...",
            shouldSort: false
        });

        // Preview Gambar Buku Sebelum Upload
        document.getElementById("foto-{{ $buku->id }}").addEventListener("change", function(event) {
            let reader = new FileReader();
            reader.onload = function(){
                document.getElementById("preview-{{ $buku->id }}").src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        });
    });
</script>
@endforeach
