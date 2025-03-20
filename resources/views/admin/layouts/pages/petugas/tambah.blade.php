<!-- Modal Add New Petugas -->
<div id="petugas-modal" tabindex="-1" aria-hidden="true" class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-black bg-opacity-40">
    <div class="relative w-full max-w-md bg-white rounded-lg shadow-lg">
        <!-- Modal Header -->
        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">
                Add New Petugas
            </h3>
            <button type="button" class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg p-2" data-modal-toggle="petugas-modal" aria-label="Close modal">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Modal Body -->
        <form action="{{ route('admin.petugas.store') }}" method="POST" enctype="multipart/form-data" class="p-4 space-y-4 max-h-[80vh] overflow-y-auto">
            @csrf
            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-800">Name</label>
                <input type="text" name="name" id="name" class="block w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="Masukkan nama" required>
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-800">Email</label>
                <input type="email" name="email" id="email" class="block w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="Masukkan email" required>
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-800">Password</label>
                <input type="password" name="password" id="password" class="block w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="Masukkan password" required>
            </div>

            <!-- Role -->
            <div>
                <label for="role" class="block text-sm font-medium text-gray-800">Select Role</label>
                <select name="role" id="role" class="block w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                    <option value="petugas">Petugas</option>
                    <option value="admin">Admin</option>
                </select>
            </div>


            <!-- Nama Lengkap -->
            <div>
                <label for="nama_lengkap" class="block text-sm font-medium text-gray-800">Full Name</label>
                <input type="text" name="nama_lengkap" id="nama_lengkap" class="block w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="Masukkan nama lengkap" required>
            </div>

            <!-- Address -->
            <div>
                <label for="alamat" class="block text-sm font-medium text-gray-700">Address</label>
                <textarea name="alamat" id="alamat" rows="3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2" placeholder="Enter full address" required></textarea>
            </div>

            <!-- Phone -->
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                <input type="number" name="phone" id="phone" pattern="^\d{10,15}$" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2" placeholder="Enter phone number" required>
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
