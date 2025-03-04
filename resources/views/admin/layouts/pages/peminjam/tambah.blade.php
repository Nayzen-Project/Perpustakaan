<!-- Main modal -->
<div id="pm-modal" tabindex="-1" aria-hidden="true" class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-black bg-opacity-40">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-lg h-full">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">
                    Create New Peminjam
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="pm-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal Body -->
            <form action="{{ route('admin.peminjam.store') }}" method="POST" enctype="multipart/form-data" class="p-4 space-y-4 max-h-[80vh] overflow-y-auto">
                @csrf

                <!-- Nama Lengkap -->
                <div>
                    <label for="nama_lengkap" class="block text-sm font-medium text-gray-700">Full Name</label>
                    <input type="text" name="nama_lengkap" id="nama_lengkap" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2" placeholder="Enter full name" required>
                </div>

                <!-- User ID -->
                <div>
                    <label for="user_id" class="block text-sm font-medium text-gray-700">User ID</label>
                    <select name="user_id" id="user_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2" required>
                        <option value="" disabled selected>Select user</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">
                                {{ $user->name }} - [{{ $user->role }}]
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <select name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2" required>
                        <option value="" disabled selected>Select email</option>
                        @foreach($users as $user)
                            <option value="{{ $user->email }}">
                                {{ $user->email }} - [{{ $user->role }}]
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Location Fields -->
                <div>
                    <label for="provinsi" class="block text-sm font-medium text-gray-700">Province</label>
                    <select id="provinsi" name="provinsi" required class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Select province</option>
                    </select>
                    <input type="hidden" name="provinsi_name" id="provinsi_name">
                </div>

                <div>
                    <label for="kabupaten" class="block text-sm font-medium text-gray-700">Regency</label>
                    <select id="kabupaten" name="kabupaten" required disabled class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Select regency</option>
                    </select>
                    <input type="hidden" name="kabupaten_name" id="kabupaten_name">
                </div>

                <div>
                    <label for="kecamatan" class="block text-sm font-medium text-gray-700">District</label>
                    <select id="kecamatan" name="kecamatan" required disabled class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Select district</option>
                    </select>
                    <input type="hidden" name="kecamatan_name" id="kecamatan_name">
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

                <!-- Photo -->
                <div>
                    <label for="photo" class="block text-sm font-medium text-gray-700">Photo</label>
                    <input type="file" name="photo" id="photo" accept="image/*" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2">
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
document.addEventListener('DOMContentLoaded', function () {
    fetchProvinces();

    document.getElementById('provinsi').addEventListener('change', function () {
        const provinceName = this.options[this.selectedIndex].text;
        document.getElementById('provinsi_name').value = provinceName; // Set nama provinsi
        fetchRegencies(this.value);
    });

    document.getElementById('kabupaten').addEventListener('change', function () {
        const regencyName = this.options[this.selectedIndex].text;
        document.getElementById('kabupaten_name').value = regencyName; // Set nama kabupaten
        fetchDistricts(this.value);
    });

    document.getElementById('kecamatan').addEventListener('change', function () {
        const districtName = this.options[this.selectedIndex].text;
        document.getElementById('kecamatan_name').value = districtName; // Set nama kecamatan
    });
});

function fetchProvinces() {
    fetch('/admin/location/get-provinces')
        .then(response => response.json())
        .then(data => {
            const provinceSelect = document.getElementById('provinsi');
            provinceSelect.innerHTML = '<option value="">Select province</option>';
            data.forEach(province => {
                const option = document.createElement('option');
                option.value = province.id;
                option.textContent = province.name;
                provinceSelect.appendChild(option);
            });
        })
        .catch(() => {
            alert('Gagal memuat provinsi. Silakan coba lagi nanti.');
        });
}

function fetchRegencies(provinceId) {
    if (!provinceId) return;
    fetch(`/admin/location/get-kabupaten/${provinceId}`)
        .then(response => response.json())
        .then(data => {
            const regencySelect = document.getElementById('kabupaten');
            regencySelect.innerHTML = '<option value="">Select regency</option>';
            data.forEach(regency => {
                const option = document.createElement('option');
                option.value = regency.id;
                option.textContent = regency.name;
                regencySelect.appendChild(option);
            });
            regencySelect.disabled = false;
        })
        .catch(() => {
            alert('Gagal memuat kabupaten. Silakan coba lagi nanti.');
        });
}

function fetchDistricts(regencyId) {
    if (!regencyId) return;
    fetch(`/admin/location/get-kecamatan/${regencyId}`)
        .then(response => response.json())
        .then(data => {
            const districtSelect = document.getElementById('kecamatan');
            districtSelect.innerHTML = '<option value="">Select district</option>';
            data.forEach(district => {
                const option = document.createElement('option');
                option.value = district.id;
                option.textContent = district.name;
                districtSelect.appendChild(option);
            });
            districtSelect.disabled = false;
        })
        .catch(() => {
            alert('Gagal memuat kecamatan. Silakan coba lagi nanti.');
        });
}
</script>

  