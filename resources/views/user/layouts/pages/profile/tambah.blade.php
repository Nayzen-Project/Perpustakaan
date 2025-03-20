@extends('user.layouts.dashboard')

@section('content')
    <main class="flex flex-1 p-6 justify-center">
        <div class="w-full max-w-3xl bg-white shadow-lg rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-6 flex"><span class="mr-2">👤</span> Profile</h1>
            
            <div class="flex flex-col items-center space-y-6">
                <!-- Profile Image -->
                <div class="flex flex-col items-center w-full">
                    <img src="https://api.dicebear.com/9.x/identicon/svg?seed={{ Auth::user()->id }}"
                         alt="User Avatar"
                         class="w-28 h-28 rounded-full border border-gray-300 object-cover">
                    <h2 class="mt-4 text-lg font-semibold text-gray-900">{{ Auth::user()->name }}</h2>
                    <p class="text-gray-600 text-sm">{{ Auth::user()->email }}</p>
                </div>

                <!-- Profile Form -->
                <div class="w-full">
                    <form action="{{ route('user.profile.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf

                       <!-- Nama Lengkap -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" required
                                class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <!-- NIK -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">NIK</label>
                            <input type="number" name="nik" required
                                class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" value="{{ Auth::user()->email }}" readonly
                                class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm p-2 bg-gray-100">
                        </div>

                        <!-- Location Fields -->
                        <div class="relative">
                            <label for="provinsi" class="block text-sm font-medium text-gray-700">Provinsi</label>
                            <select id="provinsi" name="provinsi" required
                                class="mt-1 block w-full bg-white border border-gray-300 rounded-lg shadow-sm p-3 focus:ring-blue-500 
                                       focus:border-blue-500 hover:border-blue-400 transition duration-200">
                                <option value="">Pilih provinsi</option>
                            </select>
                            <input type="hidden" name="provinsi_name" id="provinsi_name">
                        </div>
                        
                        <div class="relative">
                            <label for="kabupaten" class="block text-sm font-medium text-gray-700">Kabupaten</label>
                            <select id="kabupaten" name="kabupaten" required disabled
                                class="mt-1 block w-full bg-gray-100 border border-gray-300 rounded-lg shadow-sm p-3 focus:ring-blue-500 
                                       focus:border-blue-500 hover:border-blue-400 transition duration-200 disabled:opacity-50">
                                <option value="">Pilih kabupaten</option>
                            </select>
                            <input type="hidden" name="kabupaten_name" id="kabupaten_name">
                        </div>
                        
                        <div class="relative">
                            <label for="kecamatan" class="block text-sm font-medium text-gray-700">Kecamatan</label>
                            <select id="kecamatan" name="kecamatan" required disabled
                                class="mt-1 block w-full bg-gray-100 border border-gray-300 rounded-lg shadow-sm p-3 focus:ring-blue-500 
                                       focus:border-blue-500 hover:border-blue-400 transition duration-200 disabled:opacity-50">
                                <option value="">Pilih kecamatan</option>
                            </select>
                            <input type="hidden" name="kecamatan_name" id="kecamatan_name">
                        </div>
                        
                        <!-- Alamat -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Alamat</label>
                            <textarea name="alamat" required
                                    class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                        </div>

                        <!-- No HP -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">No. HP</label>
                            <input type="number" name="phone" required
                                class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <!-- Upload Foto -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Foto</label>
                            <input type="file" name="photo" class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm p-2">
                        </div>

                        <!-- Upload Foto NIK -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Upload Foto KTP</label>
                            <input type="file" name="foto_ktp" required class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm p-2">
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <a href="{{ url()->previous() }}" class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 mr-3">
                                Kembali
                            </a>
                            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
            fetch('/location/get-provinces')
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
            fetch(`/location/get-kabupaten/${provinceId}`)
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
            fetch(`/location/get-kecamatan/${regencyId}`)
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
@endsection
