<!-- Modal Edit Ulasan -->
@foreach ($ulasans as $ulasan)
<div id="edit-modal-{{ $ulasan->id }}" tabindex="-1" aria-hidden="true" class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-black bg-opacity-40">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-lg h-full">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">
                    Edit Ulasan
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="edit-modal-{{ $ulasan->id }}">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <!-- Modal Body -->
            <form action="{{ route('petugas.ulasan.update', $ulasan->id) }}" method="POST" enctype="multipart/form-data" class="p-4 space-y-4 max-h-[80vh] overflow-y-auto">
                @csrf
                @method('PUT')

                <!-- Ulasan -->
                <div>
                    <label for="ulasan" class="block text-sm font-medium text-gray-700">Ulasan</label>
                    <textarea name="ulasan" id="ulasan" rows="3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2" required>{{ $ulasan->ulasan }}</textarea>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300">
                        Update Ulasan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
