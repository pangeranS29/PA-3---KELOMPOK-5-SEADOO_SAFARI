<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }} - Login</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Flag Icons (versi terbaru) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.2.3/css/flag-icons.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #1a1a1a 0%, #000000 100%);
        }
    </style>

    @livewireStyles
</head>

<body class="gradient-bg text-white min-h-screen flex flex-col">
    <!-- Header / Logo -->
    <header class="w-full p-4 flex justify-start items-center pl-8">
        <a href="{{ url('/') }}">
            <img src="{{ asset('images/logo.png') }}" class="h-12 hover:scale-105 transition-transform duration-200"
                alt="Logo">
        </a>
    </header>

    <!-- Main Content -->
    <main class="flex flex-1 flex-col md:flex-row">

        <!-- Left Image with Gradient Overlay -->
        <div class="md:w-1/2 relative overflow-hidden hidden md:flex flex-col justify-between">
            {{-- <!-- Teks di bawah gambar -->
            <div class="w-full px-8 py-6 text-center bg-black bg-opacity-60">
                <h1 class="text-3xl font-bold text-yellow-400 mb-2">Selamat Datang Kembali</h1>
                <p class="text-gray-300 max-w-md mx-auto">Masuk untuk mengakses semua fitur eksklusif SeaDoo Safari
                    Samosir</p>
            </div> --}}

            <!-- Gambar -->
            <div class="relative w-full h-full">
                <img src="{{ asset('images/image.png') }}" alt="Login Image"
                    class="w-full h-full object-cover object-center transform hover:scale-105 transition duration-1000" />
                <!-- Gradient overlay agar gambar tetap gelap di atas -->
                <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-70">
                </div>
            </div>


        </div>


        <!-- Right Form Area -->
        <div class="w-full md:w-1/2 flex items-center justify-center p-6 sm:p-12">
            <div class="w-full max-w-md">
                {{ $slot }}
            </div>
        </div>
    </main>

    @livewireScripts
</body>

</html>
