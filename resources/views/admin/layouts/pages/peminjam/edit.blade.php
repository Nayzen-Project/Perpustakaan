 <!-- Main modal --> 
@foreach ($peminjams as $peminjam)
<div id="edit-modal-{{ $peminjam->id }}" tabindex="-1" aria-hidden="true" class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-black bg-opacity-40">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-lg h-full">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">
                    Edit Peminjam
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="edit-modal-{{ $peminjam->id }}">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <form action="{{ route('admin.peminjam.update', $peminjam->id) }}" method="POST" enctype="multipart/form-data" class="p-4 space-y-4 max-h-[80vh] overflow-y-auto">
                @csrf
                @method('PUT')

                <!-- Nama Lengkap -->
                <div>
                    <label for="nama_lengkap" class="block text-sm font-medium text-gray-700">Full Name</label>
                    <input type="text" name="nama_lengkap" id="nama_lengkap" value="{{ old('nama_lengkap', $peminjam->nama_lengkap) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2" placeholder="Enter full name" required>
                </div>

                <!-- User ID -->
                <div>
                    <label for="user_id" class="block text-sm font-medium text-gray-700">User ID</label>
                    <input type="text" value="{{ $peminjam->user->name }} - [{{ $peminjam->user->role }}]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2" disabled>
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" value="{{ $peminjam->user->email }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2" disabled>
                </div>


                 <!-- Dropdown Provinsi -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Province</label>
                    <select name="provinsi" class="provinsi-dropdown" data-modal-id="{{ $peminjam->id }}" required>
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
                    <select name="kabupaten" class="kabupaten-dropdown" data-modal-id="{{ $peminjam->id }}" required disabled>
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
                    <select name="kecamatan" class="kecamatan-dropdown" data-modal-id="{{ $peminjam->id }}" required disabled>
                        <option value="">Select District</option>
                        @if(isset($peminjam->location['kecamatan_id']))
                            <option value="{{ $peminjam->location['kecamatan_id'] }}" selected>{{ $peminjam->location['kecamatan'] }}</option>
                        @endif
                    </select>
                    <input type="hidden" name="kecamatan_name" class="kecamatan-name" data-modal-id="{{ $peminjam->id }}" value="{{ $peminjam->location['kecamatan'] ?? '' }}">
                </div>

                <!-- Address -->
                <div>
                    <label for="alamat" class="block text-sm font-medium text-gray-700">Address</label>
                    <textarea name="alamat" id="alamat" rows="3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2" placeholder="Enter full address" required>{{ old('alamat', $peminjam->alamat) }}</textarea>
                </div>

                <!-- Phone -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                    <input type="number" name="phone" id="phone" pattern="^\d{10,15}$" value="{{ old('phone', $peminjam->phone) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2" placeholder="Enter phone number" required>
                </div>

                <!-- Photo -->
                <div>
                    <label for="photo" class="block text-sm font-medium text-gray-700">Photo</label>
                    <input type="file" name="photo" id="photo" accept="image/*" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2">
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('.provinsi-dropdown').each(function() {
        let modalId = $(this).data('modal-id');
        let provinsiDropdown = $(this);
        let kabupatenDropdown = $('.kabupaten-dropdown[data-modal-id="' + modalId + '"]');
        let kecamatanDropdown = $('.kecamatan-dropdown[data-modal-id="' + modalId + '"]');

        // Mengambil data provinsi dari API
        $.get('/admin/location/get-provinces', function(data) {
            // Kosongkan dropdown sebelum mengisi
            provinsiDropdown.empty().append('<option value="">Select Province</option>');
            $.each(data, function(index, province) {
                provinsiDropdown.append('<option value="' + province.id + '">' + province.name + '</option>');
            });
        });

        // Ketika provinsi dipilih
        provinsiDropdown.on('change', function() {
            let provinsiId = $(this).val();
            let provinsiName = $(this).find('option:selected').text();
            $('.provinsi-name[data-modal-id="' + modalId + '"]').val(provinsiName);

            if (provinsiId) {
                // Ambil kabupaten berdasarkan provinsi
                $.get('/admin/location/get-kabupaten/' + provinsiId, function(data) {
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

        // Ketika kabupaten dipilih
        kabupatenDropdown.on('change', function() {
            let kabupatenId = $(this).val();
            let kabupatenName = $(this).find('option:selected').text();
            $('.kabupaten-name[data-modal-id="' + modalId + '"]').val(kabupatenName);

            if (kabupatenId) {
                // Ambil kecamatan berdasarkan kabupaten
                $.get('/admin/location/get-kecamatan/' + kabupatenId, function(data) {
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

        // Ketika kecamatan dipilih
        kecamatanDropdown.on('change', function() {
            let kecamatanName = $(this).find('option:selected').text();
            $('.kecamatan-name[data-modal-id="' + modalId + '"]').val(kecamatanName);
        });
    });
});
</script>