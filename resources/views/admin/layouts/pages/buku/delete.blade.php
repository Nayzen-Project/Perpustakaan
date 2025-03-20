@foreach ($bukus as $buku)
<div id="delete-modal-{{ $buku->id }}" tabindex="-1" aria-hidden="true" class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-black bg-opacity-40">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-gray-50 rounded-lg shadow-2xl">
            <!-- Close Button -->
            <button type="button" class="absolute top-3 right-3 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 flex justify-center items-center" data-modal-hide="delete-modal-{{ $buku->id }}">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>

            <!-- Modal Content -->
            <div class="p-6 text-center">
                <svg class="mx-auto mb-4 text-red-600 w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                <h3 class="mb-5 text-lg font-medium text-gray-800">Are you sure you want to delete this buku?</h3>

                <!-- Form to Confirm Deletion -->
                <form id="delete-form-{{ $buku->id }}" action="{{ route('admin.buku.destroy', $buku->id) }}" method="POST" class="hidden">
                    @csrf
                    @method('DELETE')
                </form>

                <!-- Confirmation Buttons -->
                <div class="flex justify-center space-x-4">
                    <button data-modal-hide="delete-modal-{{ $buku->id }}" type="button" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-6 py-2.5" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $buku->id }}').submit();">
                        Yes, I'm sure
                    </button>
                    <button data-modal-hide="delete-modal-{{ $buku->id }}" type="button" class="py-2.5 px-5 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-blue-700 focus:ring-4 focus:ring-gray-100">
                        No, cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach