<aside class="w-64 h-screen bg-gray-800 text-white fixed top-0 left-0 flex flex-col shadow-lg">
    <!-- Logo -->
    <div class="flex items-center space-x-2 p-4 border-b border-gray-700">
        <img src="{{ asset('images/logo.svg') }}" alt="Library Logo" class="w-8 h-8 rounded-full">
        <span class="text-white font-semibold text-lg">
            <a href="{{ route ('dashboard')}}">PERPUSTAKAAN</a>
        </span>
    </div>
    
    <!-- Menu Items -->
    <nav class="flex-1 overflow-y-auto mt-4">
        <ul class="space-y-2">
            <li>
                <a href="#" class="flex items-center space-x-3 px-4 py-2 rounded hover:bg-gray-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7v10M15 7v10M7 5h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2z"></path>
                    </svg>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center space-x-3 px-4 py-2 rounded hover:bg-gray-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7v10M15 7v10M7 5h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2z"></path>
                    </svg>
                    <span>Books</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center space-x-3 px-4 py-2 rounded hover:bg-gray-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a2 2 0 00-2-2h-3a2 2 0 00-2 2v2zM12 3v12M12 3l-3 3M12 3l3 3"></path>
                    </svg>
                    <span>Members</span>
                </a>
            </li>
        </ul>
    </nav>
</aside>