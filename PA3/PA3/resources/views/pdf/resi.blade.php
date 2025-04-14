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
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .section-title {
            font-weight: bold;
            margin-top: 20px;
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
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h2>Resi Booking</h2>
        <p>ID Booking: {{ $booking->id }}</p>
    </div>

    <div>
        <div class="section-title">Data Customer</div>
        <table class="data-table">
            <tr><td>Nama</td><td>{{ $booking->nama_customer }}</td></tr>
            <tr><td>No. Telepon</td><td>{{ $booking->no_telepon }}</td></tr>
            <tr><td>Email</td><td>{{ $booking->user->email ?? '-' }}</td></tr>
        </table>

        <div class="section-title">Detail Pemesanan</div>
        <table class="data-table">
            <tr><td>Nama Paket</td><td>{{ $booking->detail_paket->pilihpaket->nama_paket ?? '-' }}</td></tr>
            <tr><td>Jadwal Kedatangan (Check In)</td><td>{{ \Carbon\Carbon::parse($booking->waktu_mulai)->translatedFormat('d F Y') }}</td></tr>
            <tr><td>Jadwal Kepulangan (Check Out)</td><td>{{ \Carbon\Carbon::parse($booking->waktu_selesai)->translatedFormat('d F Y') }}</td></tr>
            <tr><td>Jumlah Penumpang</td><td>{{ $booking->jumlah_penumpang }}</td></tr>
            <tr><td>Total Harga</td><td>Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</td></tr>
            <tr><td>Status Pembayaran</td><td>{{ ucfirst($booking->status_pembayaran) }}</td></tr>
        </table>

        <p style="margin-top: 30px;">Terima kasih telah melakukan pemesanan!</p>
    </div>
</div>
</body>
</html>
