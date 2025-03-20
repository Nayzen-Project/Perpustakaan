<div id="peminjaman-modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <!-- Header Modal -->
        <div class="flex justify-between items-center border-b pb-2 mb-4">
            <h2 class="text-lg font-semibold">Pinjam Buku</h2>
            <button id="close-modal" class="text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
        </div>

        <!-- Form Peminjaman -->
        <form id="form-peminjaman" action="{{ route('user.peminjaman.proses', $buku) }}" method="POST">
            @csrf

            <!-- Nama Peminjam -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" value="{{ Auth::user()->name }}" class="w-full px-3 py-2 border rounded-lg bg-gray-100" readonly>
            </div>

            <!-- Judul Buku -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Judul Buku</label>
                <input type="text" value="{{ $buku->judul }}" class="w-full px-3 py-2 border rounded-lg bg-gray-100" readonly>
            </div>

            <!-- Tanggal Peminjaman (Pengambilan Buku) -->
            <div class="mb-4">
                <label for="tanggal_peminjaman" class="block text-sm font-medium text-gray-700">Tanggal Peminjaman (Pengambilan Buku)</label>
                <input type="date" name="tanggal_peminjaman" id="tanggal_peminjaman"
                       class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-blue-300">
            </div>

            <!-- Catatan Pengambilan -->
            <div class="mb-4 p-3 bg-yellow-200 text-yellow-800 rounded-lg text-sm">
                📌 Pastikan Anda mengambil buku pada tanggal yang dipilih. Buku yang tidak diambil dalam 2 hari akan dibatalkan.
            </div>

            <!-- Tombol Aksi -->
            <div class="flex justify-end">
                <button type="button" id="close-modal-btn" class="mr-2 px-4 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Pinjam</button>
            </div>
        </form>
    </div>
</div>
