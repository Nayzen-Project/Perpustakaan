<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan | @yield('title', 'Home')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- AlpineJS Script -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="h-screen w-16 bg-white shadow-lg p-4 flex flex-col transition-all duration-300 fixed top-0 left-0" 
             id="sidebar-container">
            @include('user.layouts.partials.sidebar')
        </div>        
        
        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-auto transition-all duration-300 ml-16 " id="main-content">
            @yield('content')
        </div>
    </div>
    {{-- Allert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        //message with sweetalert
        @if(session('success'))
            Swal.fire({
                icon: "success",
                title: "BERHASIL",
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @elseif(session('error'))
            Swal.fire({
                icon: "error",
                title: "GAGAL!",
                text: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif
    </script>
</body>
</html>
