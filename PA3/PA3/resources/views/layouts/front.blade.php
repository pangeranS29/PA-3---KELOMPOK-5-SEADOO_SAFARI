<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Bootstrap & Tailwind -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Libraries -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.7.0/dist/cdn.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

    <!-- Scripts -->
    @vite(['resources/css/front.css'])

    <!-- Styles -->
    @livewireStyles

    <style>
        .logo {
            width: 150px;
            /* Lebar gambar */
            height: auto;
            /* Tinggi otomatis disesuaikan agar proporsi tetap sama */
            display: block;
            /* Menghilangkan ruang tambahan di bawah gambar */
        }


        .nav_color {
            color: white !important;
            /* Mengubah warna teks link menjadi putih */
            text-decoration: none;
            /* Menghilangkan underline pada link */
            transition: color 0.3s ease;
            /* Efek transisi saat hover */
        }


        /* Base Styling */
        .btn-white {
            display: inline-block;
            /* Menggunakan inline-block agar tidak mengambil seluruh lebar */
            padding: 0.5rem 1.25rem;
            /* Mengurangi padding agar tombol lebih kecil */

            font-size: 1rem;
            /* Ukuran font */
            font-weight: 500;
            /* Ketebalan font */
            text-align: center;
            /* Teks di tengah */
            color: #1a1a1a;
            /* Warna teks (gelap) agar kontras dengan latar belakang putih */
            background-color: #ffffff;
            /* Warna latar belakang putih */
            border: 1px solid #e0e0e0;
            /* Border tipis abu-abu untuk memberikan garis batas */
            border-radius: 20px;
            /* Sudut melengkung */
            cursor: pointer;
            /* Cursor berubah menjadi pointer saat hover */
            transition: all 0.3s ease-in-out;
            /* Animasi halus untuk transisi */
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            /* Efek bayangan ringan */
        }

        /* Hover Effect */
        .btn-white:hover {
            background-color: #f0f0f0;
            /* Latar belakang sedikit lebih gelap saat hover */
            border-color: #c0c0c0;
            /* Border sedikit lebih gelap */
            box-shadow: 0 6px 8px -1px rgba(0, 0, 0, 0.1), 0 3px 6px -1px rgba(0, 0, 0, 0.08);
            /* Bayangan lebih tebal */
            transform: translateY(-2px);
            /* Efek "terangkat" saat hover */
        }
    </style>


</head>

<body>
    <main>
        <nav class="container relative py-3 ">
            <div class="flex flex-col justify-between w-full lg:flex-row lg:items-center">
                <!-- Logo & Toggler Button here -->
                <div class="flex items-center justify-between">
                    <!-- LOGO -->
                    <a href="{{ route('front.index') }}">
                        <a href="{{ route('front.index') }}">
                            <img src="{{ asset('images/logoseado.png') }}" alt="Logo" class="logo">
                        </a>
                    </a>
                    <!-- RESPONSIVE NAVBAR BUTTON TOGGLER -->
                    <div class="block lg:hidden">
                        <button class="p-1 outline-none mobileMenuButton" id="navbarToggler" data-target="#navigation">
                            <svg class="text-dark w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 8h16M4 16h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Nav Menu -->
                <div class="hidden w-full lg:block" id="navigation">
                    <div
                        class="flex flex-col items-baseline gap-4 mt-6 lg:justify-between lg:flex-row lg:items-center lg:mt-0">
                        <div
                            class="flex flex-col w-full ml-auto lg:w-auto gap-4 lg:gap-[50px] lg:items-center lg:flex-row">
                            <a href="#!" class="nav_color">Home</a>
                            <a href="#!" class="nav_color">Safari Packages</a>
                            <a href="#!" class="nav_color">Benefits</a>
                            <a href="#!" class="nav_color">Stories</a>
                            <a href="#!" class="nav_color">Maps</a>
                        </div>
                        @auth
                            <div class="flex flex-col w-full ml-auto lg:w-auto lg:gap-12 lg:items-center lg:flex-row">
                                {{-- Logout --}}
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="{{ route('logout') }}" class="btn-white"
                                        onclick="event.preventDefault();
                      this.closest('form').submit();">
                                        Log Out
                                    </a>
                                </form>
                            </div>
                        @else
                            <div class="flex flex-col w-full ml-auto lg:w-auto lg:gap-12 lg:items-center lg:flex-row">
                                <a href="{{ route('login') }}" class="btn-white">
                                    Log In
                                </a>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        {{ $slot }}
    </main>


    <!-- FOOTER -->
    <footer class="bg-black text-white py-10">
        <div class="container mx-auto px-5">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <!-- Follow Us Section -->
                <div>
                    <h2 class="text-xl font-bold mb-5">Follow Us</h2>
                    <ul>
                        <li class="mb-3 flex items-center hover:text-yellow-400 transition">
                            <i class="fab fa-instagram mr-3 text-pink-500"></i> Instagram
                        </li>
                        <li class="mb-3 flex items-center hover:text-yellow-400 transition">
                            <i class="fab fa-facebook mr-3 text-blue-500"></i> Facebook
                        </li>
                        <li class="mb-3 flex items-center hover:text-yellow-400 transition">
                            <i class="fab fa-tiktok mr-3 text-gray-500"></i> TikTok
                        </li>
                        <li class="mb-3 flex items-center hover:text-yellow-400 transition">
                            <i class="fab fa-youtube mr-3 text-red-500"></i> YouTube
                        </li>
                    </ul>
                </div>

                <!-- Location Section -->
                <div class="text-center">
                    <h2 class="text-xl font-bold text-yellow-500 mb-5">Location</h2>
                    <p>Jalan Lingkar, Tuktuk Siadong, Kabupaten Samosir, Sumatera Utara, 22395</p>
                    <div class="my-5">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3814.214630319171!2d98.84166901030349!3d2.6767433558641707!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3031ebf3b944b9dd%3A0xc0b508b6a21d8075!2sSeadoo%20Safari%20Samosir!5e1!3m2!1sid!2sid!4v1740041762917!5m2!1sid!2sid"
                            width="600" height="300" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            class="rounded-lg shadow-md border border-gray-700 w-full md:w-3/4 mx-auto"></iframe>
                    </div>
                    <p class="mt-2 text-gray-300">Working hour: 7AM - 5PM</p>
                </div>

                <!-- Booking & Information Section -->
                <div class="text-center">
                    <h2 class="text-xl font-bold text-yellow-500 mb-5">Booking & Information</h2>
                    <p class="text-green-500 text-lg font-semibold">+62 823 6959 5172 (WhatsApp)</p>
                    <div class="mt-10">
                        <h2 class="text-xl font-bold mb-5">Supported By</h2>
                        <div class="flex justify-center items-center space-x-5">
                            <img src="https://storage.googleapis.com/a1aa/image/AvxXQewEIXMIj5ejBC3rhSR3GzM8VwkVVW16HUoCofE.jpg"
                                alt="Seadoo logo" class="h-12 w-auto">
                            <img src="https://storage.googleapis.com/a1aa/image/YYrn2zY69YlQRyDyt7i_lGU3D3aa6ql7M9lSyNcnE8Y.jpg"
                                alt="Tripwe logo" class="h-12 w-auto">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="border-t border-gray-700 mt-10 pt-5 text-center text-gray-400 text-sm">
                © 2025 Seadoo Safari Samosir. All Rights Reserved.
            </div>
        </div>
    </footer>


    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true,
            duration: 300,
            easing: 'ease-out'
        });
    </script>

    <script src="{{ url('js/script.js') }}"></script>



</body>

</html>
