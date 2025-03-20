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
                    <form action="{{ route('user.profile.update', $peminjam->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <!-- Nama Lengkap -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', Auth::user()->name) }}" required
                                class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" value="{{ Auth::user()->email }}" readonly
                                class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm p-2 bg-gray-100">
                        </div>

                        <!-- Dropdown Provinsi -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Province</label>
                            <select name="provinsi" class="provinsi-dropdown w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" data-modal-id="{{ $peminjam->id }}" required>
                                <option value="{{ $peminjam->location['provinsi_id'] ?? '' }}" 
                                    @if(isset($peminjam->location['provinsi_id']) && $peminjam->location['provinsi_id'] != null) selected @endif>
                                    {{ $peminjam->location['provinsi'] ?? 'Select Province' }}
                                </option>
                                <option value="">Select Province</option>
                            </select>
                            <input type="hidden" name="provinsi_name" class="provinsi-name" data-modal-id="{{ $peminjam->id }}" value="{{ $peminjam->location['provinsi'] ?? '' }}">
                        </div>

                        <!-- Dropdown Kabupaten -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Regency</label>
                            <select name="kabupaten" class="kabupaten-dropdown w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" data-modal-id="{{ $peminjam->id }}" required disabled>
                                <option value="">Select Regency</option>
                                @if(isset($peminjam->location['kabupaten_id']))
                                    <option value="{{ $peminjam->location['kabupaten_id'] }}" selected>{{ $peminjam->location['kabupaten'] }}</option>
                                @endif
                            </select>
                            <input type="hidden" name="kabupaten_name" class="kabupaten-name" data-modal-id="{{ $peminjam->id }}" value="{{ $peminjam->location['kabupaten'] ?? '' }}">
                        </div>

                        <!-- Dropdown Kecamatan -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">District</label>
                            <select name="kecamatan" class="kecamatan-dropdown w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" data-modal-id="{{ $peminjam->id }}" required disabled>
                                <option value="">Select District</option>
                                @if(isset($peminjam->location['kecamatan_id']))
                                    <option value="{{ $peminjam->location['kecamatan_id'] }}" selected>{{ $peminjam->location['kecamatan'] }}</option>
                                @endif
                            </select>
                            <input type="hidden" name="kecamatan_name" class="kecamatan-name" data-modal-id="{{ $peminjam->id }}" value="{{ $peminjam->location['kecamatan'] ?? '' }}">
                        </div>

                        <!-- Alamat -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Alamat</label>
                            <textarea name="alamat" required
                                    class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">{{ old('alamat', $peminjam->alamat ?? '') }}</textarea>
                        </div>

                         <!-- NIK -->
                         <div>
                            <label class="block text-sm font-medium text-gray-700">NIK (Nomor Induk Kependudukan)</label>
                            <input type="text" name="nik" value="{{ old('nik', $peminjam->nik ?? '') }}" required
                                class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>

                         <!-- Foto KTP -->
                         <div>
                            <label class="block text-sm font-medium text-gray-700">Foto KTP (Opsional)</label>
                            <input type="file" name="foto_ktp" class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm p-2">
                        </div>

                        <!-- No HP -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">No. HP</label>
                            <input type="number" name="phone" value="{{ old('phone', $peminjam->phone ?? '') }}" required
                                class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <!-- Upload Foto -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Foto (Opsional)</label>
                            <input type="file" name="photo" class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm p-2">
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end space-x-4">
                            <a href="{{ url()->previous() }}" class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
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
    $(document).ready(function() {
        function fetchData(url, callback) {
            $.get(url, function(data) {
                console.log("Data fetched from " + url, data);
                callback(data);
            }).fail(function(xhr) {
                console.error("Error fetching data from " + url, xhr);
            });
        }

        $('.provinsi-dropdown').each(function() {
            let modalId = $(this).data('modal-id');
            let provinsiDropdown = $(this);
            let kabupatenDropdown = $('.kabupaten-dropdown[data-modal-id="' + modalId + '"]');
            let kecamatanDropdown = $('.kecamatan-dropdown[data-modal-id="' + modalId + '"]');

            fetchData('/location/get-provinces', function(data) {
                provinsiDropdown.empty().append('<option value="">Select Province</option>');
                $.each(data, function(index, province) {
                    provinsiDropdown.append('<option value="' + province.id + '">' + province.name + '</option>');
                });
            });

            provinsiDropdown.on('change', function() {
                let provinsiId = $(this).val();
                let provinsiName = $(this).find('option:selected').text();
                $('.provinsi-name[data-modal-id="' + modalId + '"]').val(provinsiName);

                if (provinsiId) {
                    fetchData('/location/get-kabupaten/' + provinsiId, function(data) {
                        kabupatenDropdown.empty().append('<option value="">Select Regency</option>');
                        $.each(data, function(index, kabupaten) {
                            kabupatenDropdown.append('<option value="' + kabupaten.id + '">' + kabupaten.name + '</option>');
                        });
                        kabupatenDropdown.prop('disabled', false);
                    });
                } else {
                    kabupatenDropdown.empty().prop('disabled', true);
                    kecamatanDropdown.empty().prop('disabled', true);
                }
            });

            kabupatenDropdown.on('change', function() {
                let kabupatenId = $(this).val();
                let kabupatenName = $(this).find('option:selected').text();
                $('.kabupaten-name[data-modal-id="' + modalId + '"]').val(kabupatenName);

                if (kabupatenId) {
                    fetchData('/location/get-kecamatan/' + kabupatenId, function(data) {
                        kecamatanDropdown.empty().append('<option value="">Select District</option>');
                        $.each(data, function(index, kecamatan) {
                            kecamatanDropdown.append('<option value="' + kecamatan.id + '">' + kecamatan.name + '</option>');
                        });
                        kecamatanDropdown.prop('disabled', false);
                    });
                } else {
                    kecamatanDropdown.empty().prop('disabled', true);
                }
            });

            kecamatanDropdown.on('change', function() {
                let kecamatanName = $(this).find('option:selected').text();
                $('.kecamatan-name[data-modal-id="' + modalId + '"]').val(kecamatanName);
            });
        });
    });
    </script>    
@endsection
