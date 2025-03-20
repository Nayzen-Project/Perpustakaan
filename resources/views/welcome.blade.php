<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan</title>
    @vite('resources/js/app.js')
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.0/flowbite.min.js"></script>
</head>
<body class="bg-gray-50">

    <!-- Header -->
    <header class="bg-white shadow-md py-4">
        <div class="container mx-auto flex justify-between items-center px-6">
            <h1 class="text-4xl font-bold text-black">RUANG <span class="text-red-600">LITERASI</span></h1>
            <div class="flex items-center space-x-4 ml-auto">
                <input type="text" placeholder="Search..." class="border px-4 py-2 rounded-md">
                <button class="bg-blue-600 text-white px-4 py-2 rounded-md">Search</button>
                <a href="{{ route ('login')}}">
                    <button class="bg-green-600 text-white px-4 py-2 rounded-md">Login</button>
                </a> 
            </div>                   
        </div>
    </header>

    <div class="max-w-5xl mx-auto mt-6">
        <!-- Flowbite Carousel -->
        <div id="default-carousel" class="relative w-full mb-6" data-carousel="slide">
            <!-- Carousel wrapper -->
            <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                <!-- Item 1 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="{{ asset('images/item1.jpg') }}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="Library">
                </div>
                <!-- Item 2 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="{{ asset('images/item2.jpg')}}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="Books">
                </div>
                <!-- Item 3 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="{{ asset('images/item3.jpg')}}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="Reading">
                </div>
            </div>
    
            <!-- Slider indicators -->
            <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3">
                <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
            </div>
    
            <!-- Slider controls -->
            <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50">
                    <svg class="w-4 h-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                    </svg>  
                    <span class="sr-only">Previous</span>
                </span>
            </button>
            <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50">
                    <svg class="w-4 h-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <span class="sr-only">Next</span>
                </span>
            </button>
        </div>
    
        <!-- Menu -->
        <nav class="bg-gray-200 py-3">
            <div class="container mx-auto flex justify-center space-x-6">
                <a href="/" class="text-gray-700 hover:text-blue-600 hover:underline {{ request()->is('/') ? 'text-blue-600 underline' : '' }}">About</a> 
            </div>
        </nav>
    </div>
    

    <!-- Section -->
    <section class="container mx-auto my-10 px-6">
        <h2 class="text-3xl font-bold text-center mb-3.5">About</h2>
        <p class="font-semibold text-center mb-7">
            Jelajahi dunia buku tanpa batas dengan mengakses RUANG <span class="text-red-600">LITERASI!</span><br> Akses ribuan koleksi buku kapan saja, di mana saja, dengan cara yang fleksibel dan mudah. Mulai petualangan bacaan Anda sekarang!
        </p>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            <div class="relative bg-white shadow-md rounded-lg overflow-hidden transform transition duration-300 hover:scale-105 group">
                <!-- Gambar -->
                <img src="{{ asset('images/book4.jpg') }}" alt="Book 1" class="w-full object-cover">
        
                 <!-- Konten Card -->
                <div class="p-4">
                    <h3 class="text-xl font-semibold">Laut Bercerita</h3>
                </div>

                <!-- Deskripsi yang muncul saat hover -->
                <div class="absolute bottom-0 left-0 w-full bg-white p-4 transform translate-y-full group-hover:translate-y-0 transition-all duration-300">
                    <p class="text-gray-600 mt-2 text-justify">
                        <span class="font-bold">Laut Bercerita</span> karya Leila S. Chudori adalah buku fiksi yang menceritakan kisah tentang masa lalu dan perjuangan hidup,
                        berlatar belakang sejarah Indonesia dengan pendekatan narasi yang mendalam dan emosional. Buku ini memberikan perspektif baru
                        tentang konflik dan perasaan manusia yang rumit.
                    </p>
                </div>
            </div>
            <div class="relative bg-white shadow-md rounded-lg overflow-hidden transform transition duration-300 hover:scale-105 group">
                <!-- Gambar -->
                <img src="{{ asset('images/book2.jpg') }}" alt="Book 2" class="w-full object-cover">
        
                 <!-- Konten Card -->
                <div class="p-4">
                    <h3 class="text-xl font-semibold">Atomic Habits</h3>
                </div>

                <!-- Deskripsi yang muncul saat hover -->
                <div class="absolute bottom-0 left-0 w-full bg-white p-4 transform translate-y-full group-hover:translate-y-0 transition-all duration-300">
                    <p class="text-gray-600 mt-2 text-justify">
                        <span class="font-bold">Atomic Habits </span> karya James Clear. Buku ini terkenal karena memberikan pendekatan yang sangat praktis dalam membangun kebiasaan baik dan menghilangkan kebiasaan buruk. "Atomic Habits" berfokus pada cara-cara kecil (atau "atomik") yang bisa membuat perubahan besar dalam hidup seseorang seiring berjalannya waktu.
                    </p>
                </div>
            </div>
            <div class="relative bg-white shadow-md rounded-lg overflow-hidden transform transition duration-300 hover:scale-105 group">
                <!-- Gambar -->
                <img src="{{ asset('images/book3.jpg') }}" alt="Book 3" class="w-full object-cover">
        
                 <!-- Konten Card -->
                <div class="p-4">
                    <h3 class="text-xl font-semibold">Negeri Para Bedebah</h3>
                </div>

                <!-- Deskripsi yang muncul saat hover -->
                <div class="absolute bottom-0 left-0 w-full bg-white p-4 transform translate-y-full group-hover:translate-y-0 transition-all duration-300">
                    <p class="text-gray-600 mt-2 text-justify">
                        <span class="font-bold">Negeri Para Bedebah</span> Buku ini merupakan salah satu karya yang terkenal di Indonesia, karya Guritno dan sering kali dikaitkan dengan kritik sosial yang tajam. Buku ini membahas tentang berbagai bentuk ketidakadilan dan penyalahgunaan kekuasaan yang terjadi dalam kehidupan politik dan sosial Indonesia.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6 mt-10">
        <div class="container mx-auto text-center">
            <p>&copy; 2025 Ruang Literasi. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
