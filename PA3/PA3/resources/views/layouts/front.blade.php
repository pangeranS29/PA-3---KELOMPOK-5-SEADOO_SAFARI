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

    <!-- Tambahkan di <head> jika belum ada -->
    <script defer src="https://unpkg.com/alpinejs@3.13.0/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .swal2-popup {
            background: #1f2937 !important;
            color: #fff !important;
            border-radius: 0.75rem !important;
        }
        .swal2-title, .swal2-html-container {
            color: #fff !important;
        }
        .swal2-confirm {
            background-color: #f59e0b !important;
        }
        .swal2-cancel {
            background-color: #3085d6 !important;
        }
    </style>

    @vite(['resources/css/front.css'])
    @livewireStyles

    <style>
        .logo {
            width: 150px;
            height: auto;
            display: block;
        }

        .nav_color {
            color: white !important;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .btn-white {
            display: inline-block;
            padding: 0.5rem 1.25rem;
            font-size: 1rem;
            font-weight: 500;
            text-align: center;
            color: #1a1a1a;
            background-color: #ffffff;
            border: 1px solid #e0e0e0;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .btn-white:hover {
            background-color: #f0f0f0;
            border-color: #c0c0c0;
            box-shadow: 0 6px 8px -1px rgba(0, 0, 0, 0.1), 0 3px 6px -1px rgba(0, 0, 0, 0.08);
            transform: translateY(-2px);
        }
    </style>
</head>

<body>
    <main>
        <nav class="container relative py-3 bg-gray-900">
            <div class="flex flex-col justify-between w-full lg:flex-row lg:items-center">
                <div class="flex items-center justify-between">
                    <a href="{{ route('front.index') }}">
                        <img src="{{ asset('images/logoseado.png') }}" alt="Logo" class="logo">
                    </a>
                    <div class="block lg:hidden">
                        <button class="p-1 outline-none mobileMenuButton" id="navbarToggler">
                            <svg class="w-7 h-7" fill="none" stroke="white" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 8h16M4 16h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="hidden w-full lg:block" id="navigation">
                    <div class="flex flex-col justify-between gap-4 mt-6 lg:flex-row lg:items-center lg:mt-0">
                        <!-- Navigation Links -->
                        <div
                            class="flex flex-col w-full ml-auto lg:w-auto gap-4 lg:gap-[50px] lg:items-center lg:flex-row">
                            <a href="{{ route('front.index') }}" class="nav_color">Home</a>
                            <a href="#!" class="nav_color">Safari Packages</a>
                            <a href="#!" class="nav_color">Maps</a>
                        </div>

                        <!-- Auth Section -->
                        @auth
                            <!-- Dropdown User -->
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open"
                                    class="flex items-center gap-2 px-4 py-2 text-white hover:bg-gray-700 rounded focus:outline-none w-full md:w-auto">
                                    <i class="fa-solid fa-user text-white"></i>
                                    <span class="text-white">{{ Auth::user()->name }}</span>
                                    <svg class="w-4 h-4 ml-1 text-white" fill="none" stroke="currentColor"
                                        stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div x-show="open" @click.outside="open = false" x-cloak
                                    class="mt-2 w-full md:w-56 bg-white rounded-lg shadow-lg z-50 md:absolute md:right-0 overflow-hidden">
                                    <a href="{{ url('account?tab=profile') }}"
                                        class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100 transition">
                                        <i class="fa-solid fa-id-badge mr-3 text-blue-600"></i>
                                        <span>Profile</span>
                                    </a>
                                    <a href="{{ url('account?tab=transaction') }}"
                                        class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100 transition">
                                        <i class="fa-solid fa-money-check-dollar mr-3 text-green-600"></i>
                                        <span>Transaction</span>
                                    </a>
                                    <div class="border-t border-gray-200 my-1"></div>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); this.closest('form').submit();"
                                            class="flex items-center px-4 py-3 text-red-600 hover:bg-red-50 transition">
                                            <i class="fa-solid fa-right-from-bracket mr-3"></i>
                                            <span>Log Out</span>
                                        </a>
                                    </form>
                                </div>
                            </div>
                        @else
                            <!-- Log In Button -->
                            <a href="{{ route('login') }}" class="btn-white whitespace-nowrap  ml-4 lg:ml-4">
                                Log In
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        {{ $slot }}
    </main>

    <footer class="bg-black text-white py-10">
        <div class="container mx-auto px-5">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
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

                <div class="text-center">
                    <h2 class="text-xl font-bold text-yellow-500 mb-5">Location</h2>
                    <p>Jalan Lingkar, Tuktuk Siadong, Kabupaten Samosir, Sumatera Utara, 22395</p>
                    <div class="my-5">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3814.214630319171!2d98.84166901030349!3d2.6767433558641707!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3031ebf3b944b9dd%3A0xc0b508b6a21d8075!2sSeadoo%20Safari%20Samosir!5e1!3m2!1sid!2sid!4v1740041762917!5m2!1sid!2sid"
                            width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>

                <div>
                    <h2 class="text-xl font-bold mb-5">Contact Us</h2>
                    <p>Email: info@seadoosafari.com</p>
                    <p>Phone: +62 812-3456-7890</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

    <script>
        document.getElementById('navbarToggler').addEventListener('click', function() {
            var nav = document.getElementById('navigation');
            nav.classList.toggle('hidden');
        });
    </script>

    @livewireScripts
</body>

</html>
