<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Ticket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white">
    <nav class="navbar navbar-dark bg-dark p-3">
        <a href="{{ route('booking.form') }}" class="text-white">Booking Ticket</a>
    </nav>

    <div class="container mt-5">
        @yield('content')
    </div>

    <footer class="bg-dark text-center p-3 text-white mt-5">
        © 2025 Booking Ticket
    </footer>
</body>
</html>
