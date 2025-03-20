<!-- Modal Edit Petugas -->
@foreach ($petugas as $p)
<div id="edit-modal-{{ $p->id }}" tabindex="-1" aria-hidden="true"class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-black bg-opacity-40">
    <div class="relative w-full max-w-md bg-white rounded-lg shadow-lg">
        <!-- Modal Header -->
        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">
                    Edit Petugas
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="edit-modal-{{ $p->id }}">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
            </div>

             <!-- Modal Body -->
            <form action="{{ route('admin.petugas.update', $p->id) }}" method="POST" enctype="multipart/form-data" class="p-4 space-y-4 max-h-[80vh] overflow-y-auto">
                @csrf
                @method('PUT')
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $p->user->name) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2" required>
                </div>
                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $p->user->email) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2" required>
                </div>
                <!-- Role -->
                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                    <select name="role" id="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2" required>
                        <option value="petugas" {{ $p->role == 'petugas' ? 'selected' : '' }}>Petugas</option>
                        <option value="admin" {{ $p->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>
                <!-- Full Name -->
                <div>
                    <label for="nama_lengkap" class="block text-sm font-medium text-gray-700">Full Name</label>
                    <input type="text" name="nama_lengkap" id="nama_lengkap" value="{{ old('nama_lengkap', $p->nama_lengkap) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2" required>
                </div>
                <!-- Phone -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                    <input type="number" name="phone" id="phone" value="{{ old('phone', $p->phone) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2" required>
                </div>
                <!-- Alamat -->
                <div>
                    <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                    <textarea name="alamat" id="alamat" rows="3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2" required>{{ old('alamat', $p->alamat) }}</textarea>
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
</div>
@endforeach
