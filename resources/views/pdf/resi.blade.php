<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Resi Booking</title>
    <style>
        body {
            font-family: sans-serif;
            color: #333;
        }
        .container {
            padding: 20px;
            border: 1px solid #eee;
            max-width: 700px;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .section-title {
            font-weight: bold;
            margin-top: 20px;
            font-size: 16px;
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
        }
        .data-table td {
            padding: 8px;
            border: 1px solid #ddd;
        }
        .data-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .alert {
            padding: 10px;
            margin-top: 20px;
            border-radius: 5px;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }
        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
        }
        .alert-warning {
            background-color: #fff3cd;
            color: #856404;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h2>Resi Booking</h2>
        <p>ID Booking: {{ $booking->id }}</p>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div>
        <div class="section-title">Data Customer</div>
        <table class="data-table">
            <tr><td>Nama</td><td>{{ $booking->nama_customer }}</td></tr>
            <tr><td>No. Telepon</td><td>{{ $booking->no_telepon }}</td></tr>
            <tr><td>Email</td><td>{{ $booking->user->email ?? '-' }}</td></tr>
        </table>

        <div class="section-title">Detail Pemesanan</div>
        <table class="data-table">
            <tr>
                <td>Nama Paket</td>
                <td>{{ $booking->detail_paket->pilihpaket->nama_paket ?? '-' }}</td>
            </tr>
            <tr>
                <td>Check In</td>
                <td>{{ \Carbon\Carbon::parse($booking->waktu_mulai)->translatedFormat('d F Y, H:i') }}</td>
            </tr>
            <tr>
                <td>Check Out</td>
                <td>{{ \Carbon\Carbon::parse($booking->waktu_selesai)->translatedFormat('d F Y, H:i') }}</td>
            </tr>
            <tr>
                <td>Jumlah Penumpang</td>
                <td>{{ $booking->jumlah_penumpang }}</td>
            </tr>
            @if ($booking->nama_penumpang1)
                <tr><td>Nama Penumpang 1</td><td>{{ $booking->nama_penumpang1 }}</td></tr>
            @endif
            @if ($booking->nama_penumpang2)
                <tr><td>Nama Penumpang 2</td><td>{{ $booking->nama_penumpang2 }}</td></tr>
            @endif
            @if ($booking->harga_drone)
                <tr>
                    <td>Include Drone</td>
                    <td>Rp {{ number_format($booking->harga_drone, 0, ',', '.') }}</td>
                </tr>
            @endif
            <tr>
                <td>Total Harga</td>
                <td>Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Status Pembayaran</td>
                <td>
                    @switch($booking->status_pembayaran)
                        @case('expire')
                            <span class="alert alert-error">Kadaluarsa</span>
                            @break
                        @case('settlement')
                            <span class="alert alert-success">Berhasil</span>
                            @break
                        @case('pending')
                            <span class="alert alert-warning">Menunggu Pembayaran</span>
                            @break
                        @default
                            {{ ucfirst($booking->status_pembayaran) }}
                    @endswitch
                </td>
            </tr>
        </table>

        <p style="margin-top: 30px;">Terima kasih telah melakukan pemesanan!</p>
    </div>
</div>
</body>
</html>
