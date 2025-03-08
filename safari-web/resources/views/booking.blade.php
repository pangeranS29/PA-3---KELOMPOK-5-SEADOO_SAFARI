<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Pesan Tiket</title>
    <style>
        body {
            background: #222;
            color: white;
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
        .navbar .login-btn {
            background: #ffcc00;
            color: black;
            padding: 10px 15px;
            border-radius: 8px;
            font-weight: bold;
            transition: background 0.3s ease, transform 0.2s;
        }
        .navbar .login-btn:hover {
            background: #c1a225;
            transform: scale(1.05);
        }
        .footer {
            background: #111;
            padding: 40px 0;
            color: white;
        }
        .footer h4 {
            color: #ffcc00;
            margin-bottom: 20px;
        }
        .footer ul {
            list-style: none;
            padding: 0;
        }
        .footer ul li {
            margin-bottom: 10px;
        }
        .footer ul li i {
            margin-right: 10px;
            color: #ffcc00;
        }
        .footer ul li:hover {
            color: #ffcc00;
            cursor: pointer;
        }
        .map-container iframe {
            width: 100%;
            height: 300px;
            border-radius: 12px;
            border: 2px solid #ffcc00;
            transition: transform 0.3s ease;
        }
        .map-container iframe:hover {
            transform: scale(1.02);
        }
        .logo {
            max-width: 120px;
            margin: 10px;
        }
        /* Custom styles for image and text alignment */
        .trip-image {
            width: 100%; /* Set width to 100% for responsiveness */
            height: auto; /* Maintain aspect ratio */
            max-height: 300px; /* Set a maximum height */
            object-fit: cover; /* Ensure the image covers the area without distortion */
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
    <main class="container text-center py-8 mt-5">
        <h1 class="text-4xl font-bold">PESAN TIKET</h1>
        <button class="btn btn-secondary mt-4">CARI PAKET LAIN</button>
    </main>

    <!-- COASTAL TRIP Section -->
    <section class="container bg-dark p-4 rounded">
        <div class="row align-items-center">
            <div class="col-md-6 text-center">
                <img id="mainImage" src="{{ asset('images/images.png') }}" class="trip-image rounded-lg" alt="Main Image">
                <div class="mt-2 d-flex justify-content-center">
                    <img onclick="changeImage('{{ asset('images/bea.jpg') }}')" src="{{ asset('images/bea.jpg') }}" class="img-thumbnail mx-1" width="80">
                    <img onclick="changeImage('{{ asset('images/images.png') }}')" src="{{ asset('images/images.png') }}" class="img-thumbnail mx-1" width="80">
                    <img onclick="changeImage('{{ asset('images/safa.jpeg') }}')" src="{{ asset('images/safa.jpeg') }}" class="img-thumbnail mx-1" width="80">
                </div>
            </div>
            <div class="col-md-6 bg-white text-dark p-4 rounded">
                <h2 class="text-xl font-bold">COASTAL TRIP</h2>
                <p class="text-muted">Stock: 5</p>
                <div class="flex items-center mt-2">
                    <i class="fas fa-star text-yellow-500"></i>
                    <i class="fas fa-star text-yellow-500"></i>
                    <i class="fas fa-star text-yellow-500"></i>
                    <i class="fas fa-star text-yellow-500"></i>
                    <i class="fas fa-star text-yellow-500"></i>
                    <span class="ml-2">(12,887)</span>
                </div>
                <ul class="list-unstyled mt-4">
                    <li><i class="fas fa-check-circle text-primary"></i> Everyday 7AM ~ 5PM</li>
                    <li><i class="fas fa-check-circle text-primary"></i> Self ride</li>
                    <li><i class="fas fa-check-circle text-primary"></i> Guided</li>
                    <li><i class="fas fa-check-circle text-primary"></i> Duration 30 Minutes</li>
                    <li><i class="fas fa-check-circle text-primary"></i> All riding gear is provided</li>
                    <li><i class="fas fa-check-circle text-primary"></i> Documentation Photo & Video Phone included</li>
                    <li><i class="fas fa-check-circle text-primary"></i> Bathroom Facility</li>
                    <li><i class="fas fa-check-circle text-primary"></i> Route: Around the Venue</li>
                </ul>
                <p class="text-xl font-bold mt-4">IDR 900.000 / day</p>
                <a href="{{ route('booking.form') }}" class="btn btn-warning">Booking</a>
            </div>
        </div>
    </section>

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

    <script>
        function changeImage(src) {
            document.getElementById('mainImage').src = src;
        }
    </script>
</body>
</html>
