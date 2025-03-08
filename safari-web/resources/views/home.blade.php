<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Safari Packages</title>

    <!-- Bootstrap & Tailwind -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Custom Style -->
    <style>
        body {
            background: #222;
            color: white;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .navbar {
            display: flex;
            align-items: center;
            background: rgba(0, 0, 0, 0.8);
            padding: 15px 30px;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }
        .navbar img {
            height: 50px;
            margin-left: 6%;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            font-weight: bold;
        }

        header {
            width: 100%;
            height: 100vh;
            background: url('{{ asset('images/Gambar1.png') }}') no-repeat center center/cover;
            filter: contrast(1.1) brightness(0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            position: relative;
        }
        .dropdown:hover .dropdown-menu {
            display: block;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <a href="{{ url('/') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Logo">
        </a>
        <div class="menu flex space-x-8 items-center">
            <a href="{{ url('/') }}" class="text-orange-500 hover:text-orange-600">HOME</a>
            <div class="relative dropdown">
                <a href="{{ url('/safari-packages') }}" class="text-orange-500 hover:text-orange-600">SAFARI PACKAGES <i class="fas fa-caret-down"></i></a>
                <div class="absolute left-0 mt-2 w-48 bg-black text-white shadow-lg dropdown-menu hidden">
                    <div class="border-t-2 border-orange-500"></div>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-800">PHOTO TRIP</a>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-800">COASTAL TRIP</a>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-800">BATU GANTUNG TRIP</a>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-800">AIR TERJUN SITUMURUN TRIP</a>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-800">BUKIT SIBEA-BEA TRIP</a>
                </div>
            </div>
            <div class="relative dropdown">
                <a href="#" class="text-white hover:text-gray-400">LINKS <i class="fas fa-caret-down"></i></a>
                <div class="absolute left-0 mt-2 w-48 bg-black text-white shadow-lg dropdown-menu hidden">
                    <a href="#" class="block px-4 py-2 hover:bg-gray-800">Seadoo Safari</a>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-800">BRP Indonesia</a>
                </div>
            </div>
            <a href="{{ url('/login') }}" class="text-white hover:text-gray-400">
                <i class="fas fa-user"></i>
            </a>
        </div>
    </nav>

    <!-- Header -->
    <header></header>

    <!-- Content Section -->
    <div class="container mx-auto py-12">
        <div class="text-center mb-8">
            <h1 class="text-lg font-semibold">DESTINATION</h1>
            <h2 class="text-4xl font-bold text-yellow-500">POPULAR PLACE</h2>
        </div>
        <div class="flex items-center justify-center space-x-4">
            <button id="prevBtn" class="bg-yellow-500 text-black p-2 rounded-full">
                <i class="fas fa-chevron-left"></i>
            </button>
            <div id="carousel" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                <div class="bg-gray-700 p-4 rounded-lg">
                    <img src="{{ asset('images/bea.jpg') }}" alt="Coastal Trip" class="rounded-lg mb-4 w-full h-48 object-cover">
                    <h3 class="text-yellow-500 font-semibold">COASTAL TRIP</h3>
                    <p>1 Hour</p>
                    <p>IDR 1.500.000</p>
                    <a href="{{ url('/booking') }}" class="bg-black text-white py-2 px-4 rounded mt-2 inline-block">Book Now</a>
                </div>
                <div class="bg-gray-700 p-4 rounded-lg">
                    <img src="{{ asset('images/image.png') }}" alt="Batu Gantung Trip" class="rounded-lg mb-4 w-full h-48 object-cover">
                    <h3 class="text-yellow-500 font-semibold">BATU GANTUNG TRIP</h3>
                    <p>1 Hour</p>
                    <p>IDR 2.000.000</p>
                    <a href="{{ url('/booking') }}" class="bg-black text-white py-2 px-4 rounded mt-2 inline-block">Book Now</a>
                </div>

                <div class="bg-gray-700 p-4 rounded-lg">
                    <img src="{{ asset('images/image.png') }}" alt="Batu Gantung Trip" class="rounded-lg mb-4 w-full h-48 object-cover">
                    <h3 class="text-yellow-500 font-semibold">COASTAL TRIP</h3>
                    <p>1 Hour</p>
                    <p>IDR 900.000</p>
                    <a href="/Home/booking1.html" class="bg-yellow-500 text-black py-2 px-4 rounded mt-2 inline-block">Book Now</a>
                </div>
            </div>
            <button id="nextBtn" class="bg-yellow-500 text-black p-2 rounded-full">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </div>

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
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3814.214630319171!2d98.84166901030349!3d2.6767433558641707!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3031ebf3b944b9dd%3A0xc0b508b6a21d8075!2sSeadoo%20Safari%20Samosir!5e1!3m2!1sid!2sid!4v1740041762917!5m2!1sid!2sid"
                                width="600" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
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
                                 alt="Seadoo logo"
                                 class="h-12 w-auto">
                            <img src="https://storage.googleapis.com/a1aa/image/YYrn2zY69YlQRyDyt7i_lGU3D3aa6ql7M9lSyNcnE8Y.jpg"
                                 alt="Tripwe logo"
                                 class="h-12 w-auto">
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
    <!-- Script -->
    <script>
        const carousel = document.getElementById('carousel');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');

        prevBtn.addEventListener('click', () => {
            carousel.scrollBy({ left: -carousel.clientWidth, behavior: 'smooth' });
        });

        nextBtn.addEventListener('click', () => {
            carousel.scrollBy({ left: carousel.clientWidth, behavior: 'smooth' });
        });
    </script>

</body>
</html>
