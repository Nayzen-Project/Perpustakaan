<aside id="sidebar" class="w-64 bg-gray-900 h-screen text-white p-5 fixed top-0 left-0 z-30 transform -translate-x-full transition-transform duration-300 md:translate-x-0 md:relative">
    <div class="p-3 flex items-center space-x-3 mb-6">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-8 w-8">
            <path d="M11.25 4.533A9.707 9.707 0 0 0 6 3a9.735 9.735 0 0 0-3.25.555.75.75 0 0 0-.5.707v14.25a.75.75 0 0 0 1 .707A8.237 8.237 0 0 1 6 18.75c1.995 0 3.823.707 5.25 1.886V4.533ZM12.75 20.636A8.214 8.214 0 0 1 18 18.75c.966 0 1.89.166 2.75.47a.75.75 0 0 0 1-.708V4.262a.75.75 0 0 0-.5-.707A9.735 9.735 0 0 0 18 3a9.707 9.707 0 0 0-5.25 1.533v16.103Z" />
        </svg>
        <h1 class="text-xl font-semibold text-gray-200">Ruang Literasi</h1>            
    </div>    

    <!-- Kategori Menu -->
    <div class="text-gray-400 text-sm uppercase tracking-wider mb-2">Personal</div>

    <!-- Navigasi -->
    <nav>
        <div class="relative">
            <!-- Tombol Akun -->
            <button onclick="toggleDropdown()" class="flex items-center py-2 px-4 rounded-lg bg-gray-800 hover:bg-gray-700 transition duration-200">
                <img src="https://api.dicebear.com/9.x/identicon/svg?seed={{ Auth::user()->id }}" alt="Avatar" class="w-10 h-10 rounded-full">
                <span class="ml-3 text-gray-200">{{ Auth::user()->name }}</span>
                <svg class="w-5 h-5 ml-2 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 0 1 1.06-.02L10 10.67l3.72-3.48a.75.75 0 1 1 1.06 1.06l-4.25 4a.75.75 0 0 1-1.06 0l-4.25-4a.75.75 0 0 1-.02-1.06z" clip-rule="evenodd" />
                </svg>
            </button>
        
            <!-- Dropdown -->
            <div id="dropdownMenu" class="hidden absolute left-0 mt-2 w-48 bg-gray-800 border border-gray-700 rounded-lg shadow-lg">
                <a href="#" class="block px-4 py-2 text-gray-200 hover:bg-gray-700 rounded-t-lg">Profile</a>
                <!-- Logout Form -->
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="block px-4 py-2 text-gray-200 hover:bg-gray-700 rounded-b-lg w-full text-left">Logout</button>
                </form>
            </div>
        </div>
        
        <!-- Home Menu -->
        <a href="{{ route('petugas.dashboard') }}" 
        class="flex items-center py-2 px-4 rounded-lg 
        {{ Request::routeIs('petugas.dashboard') ? 'bg-gray-800 text-white' : 'hover:bg-gray-800' }} mt-4">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 mr-3 text-gray-300">
            <path d="M11.47 3.841a.75.75 0 0 1 1.06 0l8.69 8.69a.75.75 0 1 0 1.06-1.061l-8.689-8.69a2.25 2.25 0 0 0-3.182 0l-8.69 8.69a.75.75 0 1 0 1.061 1.06l8.69-8.689Z" />
            <path d="m12 5.432 8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 0 1-.75-.75v-4.5a.75.75 0 0 0-.75-.75h-3a.75.75 0 0 0-.75.75V21a.75.75 0 0 1-.75.75H5.625a1.875 1.875 0 0 1-1.875-1.875v-6.198a2.29 2.29 0 0 0 .091-.086L12 5.432Z" />
        </svg>              
        Home
        </a>

        <!-- Dashboard Menu -->
        <a href="#" class="flex items-center py-2 px-4 rounded-lg hover:bg-gray-800 mt-2">
            <svg class="w-5 h-5 mr-3 text-gray-300" fill="none" stroke="currentColor" stroke-width="2" 
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7"/>
            </svg>
            Dashboard
        </a>

        <!-- Sub-menu -->
        <div class="ml-6 mt-1">
            <a href="{{ route('petugas.peminjam') }}" class="flex items-center py-2 px-4 rounded-lg 
            {{ Request::routeIs('petugas.peminjam') ? 'bg-gray-800 text-white' : 'hover:bg-gray-800' }} mt-2">
                Peminjam
            </a>
            <a href="{{ route('petugas.peminjaman') }}" class="flex items-center py-2 px-4 rounded-lg 
            {{ Request::routeIs('petugas.peminjaman') ? 'bg-gray-800 text-white' : 'hover:bg-gray-800' }} mt-2">
                Peminjaman
            </a>
            <a href="{{ route('petugas.denda') }}" class="flex items-center py-2 px-4 rounded-lg 
            {{ Request::routeIs('petugas.denda') ? 'bg-gray-800 text-white' : 'hover:bg-gray-800' }} mt-2">
                Denda
            </a>
            <a href="{{ route('petugas.ulasan') }}" class="flex items-center py-2 px-4 rounded-lg 
            {{ Request::routeIs('petugas.ulasan') ? 'bg-gray-800 text-white' : 'hover:bg-gray-800' }} mt-2">
                Ulasan
            </a>
        </div>
    </nav>
</aside>

<script>
    function toggleDropdown() {
        document.getElementById("dropdownMenu").classList.toggle("hidden");
    }

    // Mobile Sidebar Toggle
    function toggleSidebar() {
        document.getElementById("sidebar").classList.toggle("-translate-x-full");
    }
</script>
