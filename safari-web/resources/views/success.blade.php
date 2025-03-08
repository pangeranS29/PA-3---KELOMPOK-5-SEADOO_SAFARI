@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h1 class="text-green-500 text-2xl font-bold mb-4">Booking Berhasil!</h1>
    <p class="text-gray-600 mb-6">Terima kasih telah melakukan booking. Silakan lihat bukti booking Anda.</p>

    <a href="{{ route('booking.bukti') }}" class="bg-green-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-green-600 transition duration-300">
        Lihat Bukti Booking
    </a>
</div>
@endsection
