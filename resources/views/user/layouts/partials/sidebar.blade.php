<div class="flex-1">
    <!-- Button toggle sidebar -->
    <button class="self-end mb-4" onclick="toggleSidebar()">☰</button>
    
    <!-- Logo -->
    <div class="flex items-center space-x-2">
        <a href="{{ route('user.dashboard') }}">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-8 w-8 text-gray-600">
                <path d="M11.25 4.533A9.707 9.707 0 0 0 6 3a9.735 9.735 0 0 0-3.25.555.75.75 0 0 0-.5.707v14.25a.75.75 0 0 0 1 .707A8.237 8.237 0 0 1 6 18.75c1.995 0 3.823.707 5.25 1.886V4.533ZM12.75 20.636A8.214 8.214 0 0 1 18 18.75c.966 0 1.89.166 2.75.47a.75.75 0 0 0 1-.708V4.262a.75.75 0 0 0-.5-.707A9.735 9.735 0 0 0 18 3a9.707 9.707 0 0 0-5.25 1.533v16.103Z" />
            </svg>
        </a>
        <a href="{{ route('user.dashboard') }}" 
           class="text-xl font-semibold text-gray-700 sidebar-text opacity-0 transition-all duration-300 delay-200 whitespace-nowrap">Ruang Literasi</a>
    </div>

    <ul class="mt-6 border-t pt-4 space-y-4 flex flex-col justify-center items-center w-full">
        <!-- Home -->
        <li class="w-full">
            <a href="{{ route('user.dashboard') }}" 
               class="flex items-center space-x-4 p-2 rounded-md transition-all duration-200 group
                      {{ Request::routeIs('user.dashboard') ? 'bg-gray-300 text-gray-800' : '' }}
                      hover:bg-gray-200 hover:text-gray-800">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 flex-shrink-0">
                    <path d="M11.47 3.841a.75.75 0 0 1 1.06 0l8.69 8.69a.75.75 0 1 0 1.06-1.061l-8.689-8.69a2.25 2.25 0 0 0-3.182 0l-8.69 8.69a.75.75 0 1 0 1.061 1.06l8.69-8.689Z" />
                    <path d="m12 5.432 8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 0 1-.75-.75v-4.5a.75.75 0 0 0-.75-.75h-3a.75.75 0 0 0-.75.75V21a.75.75 0 0 1-.75.75H5.625a1.875 1.875 0 0 1-1.875-1.875v-6.198a2.29 2.29 0 0 0 .091-.086L12 5.432Z" />
                </svg>                   
    
                <span class="sidebar-text opacity-0 transition-all duration-300 delay-200 whitespace-nowrap">Home</span>
            </a>
        </li>
    
        <!-- Buku -->
        <li class="w-full">
            <a href="{{ route('user.buku.index') }}" 
            class="flex items-center space-x-4 p-2 rounded-md transition-all duration-200 group
                    {{ request()->routeIs('user.buku.index') || request()->routeIs('user.buku.show') ? 'bg-gray-300 text-gray-800' : '' }}
                    hover:bg-gray-200 hover:text-gray-800">                 
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 flex-shrink-0">
                    <path fill-rule="evenodd" d="M5.25 2.25a3 3 0 0 0-3 3v4.318a3 3 0 0 0 .879 2.121l9.58 9.581c.92.92 2.39 1.186 3.548.428a18.849 18.849 0 0 0 5.441-5.44c.758-1.16.492-2.629-.428-3.548l-9.58-9.581a3 3 0 0 0-2.122-.879H5.25ZM6.375 7.5a1.125 1.125 0 1 0 0-2.25 1.125 1.125 0 0 0 0 2.25Z" clip-rule="evenodd" />
                </svg>                      
                <span class="sidebar-text opacity-0 transition-all duration-300 delay-200 whitespace-nowrap">Daftar Buku</span>
            </a>
        </li>

        <!-- Koleksi -->
        <li class="w-full">
            <a href="{{ route('user.koleksi.index') }}" 
               class="flex items-center space-x-4 p-2 rounded-md transition-all duration-200 group
                      {{ Request::routeIs('user.koleksi.index') ? 'bg-gray-300 text-gray-800' : '' }}
                      hover:bg-gray-200 hover:text-gray-800">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 flex-shrink-0">
                        <path fill-rule="evenodd" d="M6.32 2.577a49.255 49.255 0 0 1 11.36 0c1.497.174 2.57 1.46 2.57 2.93V21a.75.75 0 0 1-1.085.67L12 18.089l-7.165 3.583A.75.75 0 0 1 3.75 21V5.507c0-1.47 1.073-2.756 2.57-2.93Z" clip-rule="evenodd" />
                      </svg>                                       
    
                <span class="sidebar-text opacity-0 transition-all duration-300 delay-200 whitespace-nowrap">Koleksi Saya</span>
            </a>
        </li>

        <!-- Daftar Peminjaman -->
        <li class="w-full">
            <a href="{{ route('user.daftar.peminjaman') }}" 
               class="flex items-center space-x-4 p-2 rounded-md transition-all duration-200 group
                      {{ Request::routeIs('user.daftar.peminjaman') ? 'bg-gray-300 text-gray-800' : '' }}
                      hover:bg-gray-200 hover:text-gray-800">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 flex-shrink-0">
                        <path d="M3.375 3C2.339 3 1.5 3.84 1.5 4.875v.75c0 1.036.84 1.875 1.875 1.875h17.25c1.035 0 1.875-.84 1.875-1.875v-.75C22.5 3.839 21.66 3 20.625 3H3.375Z" />
                        <path fill-rule="evenodd" d="m3.087 9 .54 9.176A3 3 0 0 0 6.62 21h10.757a3 3 0 0 0 2.995-2.824L20.913 9H3.087Zm6.163 3.75A.75.75 0 0 1 10 12h4a.75.75 0 0 1 0 1.5h-4a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                      </svg>                      
                <span class="sidebar-text opacity-0 transition-all duration-300 delay-200 whitespace-nowrap">Daftar Peminjaman</span>
            </a>
        </li>
    </ul>
</div>
<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar-container');
        const mainContent = document.getElementById('main-content');
        const sidebarTextElements = document.querySelectorAll('.sidebar-text');

        if (sidebar.classList.contains('w-16')) {
            // Buka Sidebar
            sidebar.classList.remove('w-16');
            sidebar.classList.add('w-64');
            mainContent.classList.remove('ml-16');
            mainContent.classList.add('ml-64');

            setTimeout(() => {
                sidebarTextElements.forEach(el => {
                    el.classList.remove('opacity-0');
                });
            }, 200);
        } else {
            // Tutup Sidebar
            sidebarTextElements.forEach(el => {
                el.classList.add('opacity-0');
            });

            setTimeout(() => {
                sidebar.classList.remove('w-64');
                sidebar.classList.add('w-16');
                mainContent.classList.remove('ml-64');
                mainContent.classList.add('ml-16');
            }, 200);
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        const sidebar = document.getElementById('sidebar-container');
        sidebar.classList.add('w-16');
    });
</script>
