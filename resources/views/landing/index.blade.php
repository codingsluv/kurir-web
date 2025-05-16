<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Antar.In</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@tailwindcss/browser@latest"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .hero-section {
            background-image: linear-gradient(to bottom, rgba(252, 211, 77, 0.1), rgba(245, 158, 11, 0.3)), url("{{ asset('sbadmin2/img/background-landing.png') }}"); /* Pastikan path ini benar */
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="bg-gray-100">
    <header class="bg-white shadow-md py-4">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center">
                <a href="/" class="text-xl font-semibold text-blue-600">
                    <span class="text-orange-500">Antar</span>In
                </a>
                <nav class="hidden md:block">
                    <ul class="flex space-x-6">
                        <li><a href="#layanan" class="hover:text-orange-500 transition duration-300 text-gray-700">Layanan</a></li>
                        <li><a href="#testimoni" class="hover:text-orange-500 transition duration-300 text-gray-700">Testimoni</a></li>
                        <li><a href="#tentang-kami" class="hover:text-orange-500 transition duration-300 text-gray-700">Tentang Kami</a></li>
                        <li>
                            <a href="/login" class="bg-orange-500 text-white px-6 py-2 rounded-full hover:bg-orange-600 transition duration-300 font-semibold">
                                Masuk
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="md:hidden">
                    <button id="hamburger-btn" class="text-gray-700 focus:outline-none" aria-label="Toggle Navigation">
                        <svg id="hamburger-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                        <svg id="close-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 hidden">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>

                    </button>
                    <div id="mobile-menu" class="hidden fixed top-0 right-0 h-full w-80 bg-white shadow-lg z-50">
                        <div class="p-6">
                            <div class="flex justify-end mb-4">
                                <button id="close-menu-btn" class="text-gray-700 focus:outline-none" aria-label="Close Menu">
                                     <svg  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                            <nav class="block">
                                <ul class="space-y-4">
                                    <li><a href="#layanan" class="block hover:text-orange-500 transition duration-300 text-gray-700 text-lg">Layanan</a></li>
                                    <li><a href="#testimoni" class="block hover:text-orange-500 transition duration-300 text-gray-700 text-lg">Testimoni</a></li>
                                    <li><a href="#tentang-kami" class="block hover:text-orange-500 transition duration-300 text-gray-700 text-lg">Tentang Kami</a></li>
                                    <li>
                                        <a href="/login" class="bg-orange-500 text-white px-6 py-2 rounded-full hover:bg-orange-600 transition duration-300 font-semibold text-lg block">
                                            Masuk
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main>
        <section id="hero" class="hero-section text-gray-800 text-center py-32 px-4">
            <div class="container mx-auto">
                <h2 class="text-4xl font-bold mb-6 text-white">Pengiriman Cepat & Terpercaya</h2>
                <p class="text-xl mb-10 text-gray-700">
                    Solusi pengiriman terbaik untuk kebutuhan Anda.
                </p>
                <a href="#layanan" class="bg-yellow-400 text-white px-8 py-3 rounded-full hover:bg-yellow-500 transition duration-300 text-lg font-semibold">
                    Pesan Sekarang
                </a>
            </div>
        </section>

        <section id="layanan" class="bg-gray-100 py-16 px-4">
            <div class="container mx-auto">
                <h2 class="text-2xl font-semibold text-center mb-12 text-orange-500">Layanan Kami</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    <div class="bg-white rounded-lg shadow-md p-8 flex flex-col sm:flex-row items-center gap-6">
                        <img src="https://placehold.co/100x100/EEE/31343C" alt="Pengiriman Cepat" class="rounded-full">
                        <div>
                            <h3 class="text-xl font-semibold mb-3 text-yellow-500">Pengiriman Cepat</h3>
                            <p class="text-gray-700">Paket Anda sampai dengan cepat ke tujuan.</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow-md p-8 flex flex-col sm:flex-row items-center gap-6">
                        <img src="https://placehold.co/100x100/EEE/31343C" alt="Pengiriman Aman" class="rounded-full">
                        <div>
                            <h3 class="text-xl font-semibold mb-3 text-yellow-500">Pengiriman Aman</h3>
                            <p class="text-gray-700">Paket Anda dijamin aman selama proses pengiriman.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="testimoni" class="bg-blue-100 py-16 px-4">
            <div class="container mx-auto">
                <h2 class="text-2xl font-semibold text-center mb-12 text-orange-500">Apa Kata Mereka?</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                    <div class="bg-white rounded-lg shadow-md p-6 flex flex-col items-center text-center">
                        <img src="https://placehold.co/80x80/EEE/31343C" alt="Testimoni 1" class="rounded-full mb-4">
                        <p class="text-gray-700 mb-4">"Pelayanannya sangat cepat dan ramah. Paket saya sampai tepat waktu!"</p>
                        <h3 class="text-lg font-semibold text-yellow-500">- Budi, Pontianak</h3>
                    </div>
                    <div class="bg-white rounded-lg shadow-md p-6 flex flex-col items-center text-center">
                        <img src="https://placehold.co/80x80/EEE/31343C" alt="Testimoni 2" class="rounded-full mb-4">
                        <p class="text-gray-700 mb-4">"Pengirimannya aman dan terpercaya. Saya tidak khawatir paket saya rusak."</p>
                        <h3 class="text-lg font-semibold text-yellow-500">- Siti, Sintang</h3>
                    </div>
                    <div class="bg-white rounded-lg shadow-md p-6 flex flex-col items-center text-center">
                        <img src="https://placehold.co/80x80/EEE/31343C" alt="Testimoni 3" class="rounded-full mb-4">
                        <p class="text-gray-700 mb-4">"Harganya terjangkau dan pelayanannya memuaskan."</p>
                        <h3 class="text-lg font-semibold text-yellow-500">- Andi, Singkawang</h3>
                    </div>
                </div>
            </div>
        </section>

        <section id="tentang-kami" class="bg-gray-100 py-16 px-4">
            <div class="container mx-auto">
                <h2 class="text-2xl font-semibold text-center mb-12 text-orange-500">Tentang Kami</h2>
                <div class="flex flex-col md:flex-row items-center gap-12">
                    <img src="{{ asset('sbadmin2/img/about-us.jpg') }}" alt="Tentang Kami" class="rounded-lg shadow-md w-full md:w-1/2">
                    <div class="text-gray-700">
                        <h4 class="text-xl font-semibold mb-4 text-yellow-500">Misi Kami</h4>
                        <p class="text-lg mb-6">
                            Menjadi solusi pengiriman terpercaya dan efisien untuk bisnis dan perorangan.
                        </p>
                        <h4 class="text-xl font-semibold mb-4 text-yellow-500">Visi Kami</h4>
                        <p class="text-lg">
                            Menjadi pemimpin pasar dalam layanan pengiriman dengan mengutamakan kepuasan pelanggan.
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-gray-800 text-white py-4">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; {{ date('Y') }} KirimCepat. Hak Cipta Dilindungi.</p>
        </div>
    </footer>

    <script>
        // Smooth scrolling untuk tautan navigasi
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Hamburger menu functionality
        const hamburgerBtn = document.getElementById('hamburger-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const closeMenuBtn = document.getElementById('close-menu-btn');
        const hamburgerIcon = document.getElementById('hamburger-icon');
        const closeIcon = document.getElementById('close-icon');

        if (hamburgerBtn && mobileMenu && closeMenuBtn) {
            hamburgerBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
                hamburgerIcon.classList.toggle('hidden');
                closeIcon.classList.toggle('hidden');
                document.body.classList.add('overflow-hidden'); // Prevent scrolling
            });

            closeMenuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
                hamburgerIcon.classList.toggle('hidden');
                closeIcon.classList.toggle('hidden');
                document.body.classList.remove('overflow-hidden');
            });
        }

        // Close menu when clicking outside
        document.addEventListener('click', (event) => {
            if (!mobileMenu.classList.contains('hidden') && !mobileMenu.contains(event.target) && event.target !== hamburgerBtn) {
                mobileMenu.classList.add('hidden');
                hamburgerIcon.classList.toggle('hidden');
                closeIcon.classList.toggle('hidden');
                document.body.classList.remove('overflow-hidden');
            }
        });
    </script>
</body>
</html>
