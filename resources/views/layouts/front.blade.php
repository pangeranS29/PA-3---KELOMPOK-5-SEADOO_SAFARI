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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>


    <!-- Tambahkan di <head> jika belum ada -->
    <script defer src="https://unpkg.com/alpinejs@3.13.0/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .swal2-popup {
            background: #1f2937 !important;
            color: #fff !important;
            border-radius: 0.75rem !important;
        }

        .swal2-title,
        .swal2-html-container {
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
        <nav class="bg-black py-3 sticky top-0 z-50 shadow-md transition-all duration-300">
            <div class="container mx-auto px-4">
                <div class="flex justify-between items-center">
                    <!-- Logo -->
                    <a href="{{ route('front.index') }}" class="flex items-center">
                        <img src="{{ asset('images/logoseado.png') }}" alt="Logo"
                            class="h-10 md:h-12 transition-transform hover:scale-105">
                    </a>

                    <!-- Desktop Navigation -->
                    <div class="hidden lg:flex items-center space-x-6">
                        <!-- Navigation Links -->
                        <div class="flex items-center space-x-6">
                            <a href="{{ route('front.index') }}"
                                class="text-white hover:text-yellow-400 transition-colors duration-200 font-medium text-sm">Beranda</a>

                            <!-- Paket Safari Jetski Dropdown -->
                            <div class="relative group" x-data="{ open: false }">
                                <button @click="open = !open"
                                    class="text-white hover:text-yellow-400 transition-colors duration-200 font-medium text-sm flex items-center">
                                    Safari Packages
                                    <svg class="w-4 h-4 ml-1 transition-transform duration-200"
                                        :class="{ 'rotate-180': open }" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div x-show="open" @click.outside="open = false" x-cloak
                                    class="absolute left-0 mt-2 w-48 bg-white rounded-lg shadow-lg z-50 overflow-hidden border border-gray-200">
                                    <div class="py-1">
                                        @foreach (\App\Models\PilihPaket::with([
        'detail_paket' => function ($query) {
            $query->limit(1);
        },
    ])->has('detail_paket')->get() as $paket)
                                            <a href="{{ route('front.detail', $paket->detail_paket->first()->id) }}"
                                                class="block px-4 py-2 text-gray-800 hover:bg-yellow-400 hover:text-gray-900 transition-colors duration-200 text-sm">
                                                {{ $paket->nama_paket }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <a href="https://www.google.com/maps/place/Seadoo+Safari+Samosir/@2.676738,98.844249,16z/data=!4m6!3m5!1s0x3031ebf3b944b9dd:0xc0b508b6a21d8075!8m2!3d2.676738!4d98.8442493!16s%2Fg%2F11vx6z7qkx?hl=en&entry=ttu"
                                class="text-white hover:text-yellow-400 transition-colors duration-200 font-medium text-sm"
                                target="_blank" rel="noopener noreferrer">
                                Lokasi
                            </a>
                        </div>

                        <!-- Auth Section -->
                        <div class="flex items-center space-x-3 ml-4">
                            @auth
                                <!-- Notification Dropdown -->
                                <div class="relative" x-data="notificationDropdown()">
                                    <button @click="toggleDropdown()"
                                        class="relative p-2 text-white hover:text-yellow-400 rounded-full focus:outline-none transition-colors duration-300">
                                        <i class="fa-solid fa-bell text-xl"></i>
                                        <template x-if="unreadCount > 0">
                                            <span
                                                class="absolute top-0 right-0 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center transform translate-x-1 -translate-y-1"
                                                x-text="unreadCount"></span>
                                        </template>
                                    </button>

                                    <!-- Dropdown Panel -->
                                    <div x-show="open" @click.outside="open = false" x-cloak
                                        class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-xl z-50 border border-gray-200">
                                        <div
                                            class="px-4 py-3 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
                                            <h3 class="text-lg font-semibold text-gray-800">Berita Terbaru</h3>
                                            {{-- <button @click="markAllAsRead()" class="text-sm text-blue-600 hover:text-blue-800">Tandai sudah dibaca</button> --}}
                                        </div>

                                        <div class="max-h-96 overflow-y-auto">
                                            <template x-if="notifications.length === 0">
                                                <div class="p-4 text-center text-gray-500">
                                                    Tidak ada berita terbaru
                                                </div>
                                            </template>

                                            <template x-for="berita in notifications" :key="berita.id">
                                                <a :href="'{{ route('front.berita.show', '') }}/' + berita.slug"
                                                    class="flex items-start px-4 py-3 hover:bg-gray-50 transition border-b border-gray-100 last:border-b-0">
                                                    <div class="flex-shrink-0 mr-3">
                                                        <img :src="berita.gambar ? (berita.gambar.startsWith('http') ? berita
                                                                .gambar : '/storage/' + berita.gambar) :
                                                            '/images/news-placeholder.jpg'"
                                                            :alt="berita.judul"
                                                            class="h-12 w-12 object-cover rounded-lg">
                                                    </div>
                                                    <div class="flex-1 min-w-0">
                                                        <h4 class="text-sm font-medium text-gray-900 truncate"
                                                            x-text="berita.judul"></h4>
                                                        <p class="text-xs text-gray-500 mt-1"
                                                            x-text="berita.tanggal_publikasi"></p>
                                                    </div>
                                                    <template x-if="!berita.dibaca">
                                                        <span class="ml-2 w-2 h-2 bg-blue-500 rounded-full"></span>
                                                    </template>
                                                </a>
                                            </template>
                                        </div>

                                        <div class="px-4 py-2 border-t border-gray-200 bg-gray-50 text-center">
                                            <a href="{{ route('front.berita.index') }}"
                                                class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                                                Lihat Semua Berita
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- User Dropdown -->
                                <div class="relative" x-data="{ open: false }">
                                    <button @click="open = !open"
                                        class="flex items-center space-x-2 px-3 py-2 text-white hover:text-yellow-400 rounded-lg focus:outline-none transition-colors duration-300">
                                        <div class="w-8 h-8 rounded-full bg-gray-700 flex items-center justify-center">
                                            <i class="fa-solid fa-user text-white"></i>
                                        </div>
                                        <span class="font-medium">{{ Auth::user()->name }}</span>
                                        <svg class="w-4 h-4 transition-transform duration-200"
                                            :class="{ 'rotate-180': open }" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </button>

                                    <div x-show="open" @click.outside="open = false" x-cloak
                                        class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-xl z-50 border border-gray-200 overflow-hidden">
                                        <div class="py-1">
                                            <a href="{{ url('account?tab=profile') }}"
                                                class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                                                <i class="fa-solid fa-id-badge mr-3 text-blue-500"></i>
                                                <span>Profile</span>
                                            </a>
                                            <a href="{{ url('account?tab=transaction') }}"
                                                class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                                                <i class="fa-solid fa-money-check-dollar mr-3 text-green-500"></i>
                                                <span>Transaksi</span>
                                            </a>
                                            <div class="border-t border-gray-200"></div>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <button type="submit"
                                                    class="w-full flex items-center px-4 py-3 text-red-600 hover:bg-red-50 transition-colors duration-200">
                                                    <i class="fa-solid fa-right-from-bracket mr-3"></i>
                                                    <span>Log Out</span>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <a href="{{ route('login') }}"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-black font-medium py-1.5 px-4 rounded-full transition-colors duration-200 text-sm">
                                    Log In
                                </a>
                            @endauth
                        </div>
                    </div>

                    <!-- Mobile Menu Button -->
                    <div class="lg:hidden">
                        <button id="navbarToggler" class="text-white focus:outline-none">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Mobile Navigation -->
                <div id="mobileNavigation" class="lg:hidden hidden mt-3 pb-3">
                    <div class="flex flex-col space-y-3">
                        <a href="{{ route('front.index') }}"
                            class="text-white hover:text-yellow-400 px-3 py-1.5 rounded transition-colors duration-200 text-sm">Beranda</a>

                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open"
                                class="flex items-center justify-between w-full text-white hover:text-yellow-400 px-3 py-1.5 rounded transition-colors duration-200 text-sm">
                                <span>Paket Safari Jetski</span>
                                <svg class="w-4 h-4 ml-2 transition-transform duration-200"
                                    :class="{ 'rotate-180': open }" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="open" class="mt-1 ml-4 space-y-1">
                                @foreach (\App\Models\PilihPaket::with([
        'detail_paket' => function ($query) {
            $query->limit(1);
        },
    ])->has('detail_paket')->get() as $paket)
                                    <a href="{{ route('front.detail', $paket->detail_paket->first()->id) }}"
                                        class="block px-3 py-1.5 text-gray-300 hover:text-yellow-400 transition-colors duration-200 text-sm">
                                        {{ $paket->nama_paket }}
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        <a href="https://www.google.com/maps/place/Seadoo+Safari+Samosir/@2.676738,98.844249,16z/data=!4m6!3m5!1s0x3031ebf3b944b9dd:0xc0b508b6a21d8075!8m2!3d2.676738!4d98.8442493!16s%2Fg%2F11vx6z7qkx?hl=en&entry=ttu"
                            class="text-white hover:text-yellow-400 px-3 py-1.5 rounded transition-colors duration-200 text-sm"
                            target="_blank" rel="noopener noreferrer">
                            Lokasi
                        </a>

                        @auth
                            <div class="pt-3 border-t border-gray-700 mt-2">
                                <a href="{{ url('account?tab=profile') }}"
                                    class="flex items-center text-white hover:text-yellow-400 px-3 py-1.5 rounded transition-colors duration-200 text-sm">
                                    <i class="fa-solid fa-id-badge mr-2 text-sm"></i>
                                    <span>Profile</span>
                                </a>
                                <a href="{{ url('account?tab=transaction') }}"
                                    class="flex items-center text-white hover:text-yellow-400 px-3 py-1.5 rounded transition-colors duration-200 text-sm">
                                    <i class="fa-solid fa-money-check-dollar mr-2 text-sm"></i>
                                    <span>Transaksi</span>
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="flex items-center w-full text-white hover:text-yellow-400 px-3 py-1.5 rounded transition-colors duration-200 text-sm">
                                        <i class="fa-solid fa-right-from-bracket mr-2 text-sm"></i>
                                        <span>Log Out</span>
                                    </button>
                                </form>
                            </div>
                        @else
                            <a href="{{ route('login') }}"
                                class="bg-yellow-500 hover:bg-yellow-600 text-black font-medium py-1.5 px-4 rounded-full transition-colors duration-200 text-sm text-center mt-2">
                                Log In
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>


        {{ $slot }}
    </main>

    <footer class="bg-black text-white pt-12 pb-6">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Follow Us Section (Geser ke kanan dan rata kanan) -->
            <div class="ml-20">
    <h3 class="text-xl font-bold mb-4 text-yellow-400 border-b border-yellow-400 pb-2 inline-block">
        Follow Us</h3>
    <ul class="space-y-3 mt-4">
        <li>
            <a href="https://www.instagram.com/seadoosafarisamosir/"
                class="flex items-center text-gray-300 hover:text-yellow-400 transition-colors duration-200">
                <i class="fab fa-instagram text-lg mr-3 w-6 text-center"></i>
                <span>Instagram</span>
            </a>
        </li>
        <li>
            <a href="https://web.facebook.com/profile.php?id=61559648390682"
                class="flex items-center text-gray-300 hover:text-yellow-400 transition-colors duration-200">
                <i class="fab fa-facebook text-lg mr-3 w-6 text-center"></i>
                <span>Facebook</span>
            </a>
        </li>
        <li>
            <a href="https://www.tiktok.com/@seadoosafarisamosir?is_from_webapp=1&sender_device=pc"
                class="flex items-center text-gray-300 hover:text-yellow-400 transition-colors duration-200">
                <i class="fab fa-tiktok text-lg mr-3 w-6 text-center"></i>
                <span>Tiktok</span>
            </a>
        </li>
        <li>
            <a href="https://www.youtube.com/@Seadoo_SafariSamosir"
                class="flex items-center text-gray-300 hover:text-yellow-400 transition-colors duration-200">
                <i class="fab fa-youtube text-lg mr-3 w-6 text-center"></i>
                <span>Youtube</span>
            </a>
        </li>
    </ul>
</div>

            <!-- Location Section -->
            <div class="text-center md:text-left">
                <h3 class="text-xl font-bold mb-4 text-yellow-400 border-b border-yellow-400 pb-2 inline-block">
                    Location</h3>
                <p class="text-gray-300 mt-4">Jalan Lingkar, Tuktuk Siadong, Kabupaten Samosir, Sumatera Utara, 22395</p>
                <div class="mt-4 rounded-lg overflow-hidden border border-gray-700">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3814.214630319171!2d98.84166901030349!3d2.6767433558641707!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3031ebf3b944b9dd%3A0xc0b508b6a21d8075!2sSeadoo%20Safari%20Samosir!5e1!3m2!1sid!2sid!4v1740041762917!5m2!1sid!2sid"
                        width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>

            <!-- Contact Us Section -->
            <div>
                <h3 class="text-xl font-bold mb-4 text-yellow-400 border-b border-yellow-400 pb-2 inline-block">
                    Contact Us</h3>
                <ul class="space-y-3 mt-4">
                    <li>
                        <a href="mailto:info@seadoosafari.com"
                            class="flex items-center text-gray-300 hover:text-yellow-400 transition-colors duration-200">
                            <i class="fas fa-envelope text-lg mr-3 w-6 text-center"></i>
                            <span>info@seadoosafari.com</span>
                        </a>
                    </li>
                    <li>
                        <a href="tel:+6281234567890"
                            class="flex items-center text-gray-300 hover:text-yellow-400 transition-colors duration-200">
                            <i class="fas fa-phone-alt text-lg mr-3 w-6 text-center"></i>
                            <span>082369595172</span>
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center text-gray-300">
                            <i class="fas fa-clock text-lg mr-3 w-6 text-center"></i>
                            <span>Open Daily: 08:00 - 18:00 WIB</span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Copyright -->
        <div class="border-t border-gray-800 mt-8 pt-6 text-center text-gray-400 text-sm">
            <p>&copy; {{ date('Y') }} Seadoo Safari. All rights reserved.</p>
        </div>
    </div>
</footer>


    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

    <script>
        // Mobile menu toggle
        document.getElementById('navbarToggler').addEventListener('click', function() {
            const mobileNav = document.getElementById('mobileNavigation');
            mobileNav.classList.toggle('hidden');
        });

        // Notification dropdown logic
        function notificationDropdown() {
            return {
                open: false,
                notifications: [],
                unreadCount: 0,
                isLoading: false,

                fetchNotifications() {
                    this.isLoading = true;
                    fetch('{{ route('front.api.berita.latest') }}', {
                            headers: {
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            credentials: 'include'
                        })
                        .then(response => response.json())
                        .then(data => {
                            this.notifications = data;
                            this.unreadCount = data.filter(berita => !berita.dibaca).length;
                            this.isLoading = false;
                        })
                        .catch(() => this.isLoading = false);
                },

                markAllAsRead() {
                    fetch('{{ route('front.api.berita.markAllAsRead') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            },
                            credentials: 'include'
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                this.notifications.forEach(berita => {
                                    berita.dibaca = true;
                                });
                                this.unreadCount = 0;
                            }
                        });
                },

                toggleDropdown() {
                    this.open = !this.open;
                    if (this.open && this.unreadCount > 0) {
                        this.markAllAsRead();
                    }
                },

                init() {
                    this.fetchNotifications();
                }
            }
        }

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const nav = document.querySelector('nav');
            if (window.scrollY > 10) {
                nav.classList.add('py-2');
                nav.classList.remove('py-3');
            } else {
                nav.classList.add('py-3');
                nav.classList.remove('py-2');
            }
        });
    </script>

    @livewireScripts
</body>

</html>
