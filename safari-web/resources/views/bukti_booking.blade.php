@extends('layouts.app')

@section('content')
<div class="flex flex-col items-center min-h-screen bg-gray-900 text-white">
    <h1 class="text-4xl font-bold mt-16">DETAIL PESANAN</h1>

    <div class="bg-gray-700 p-8 rounded-lg w-11/12 md:w-2/3 lg:w-1/2 mt-8 shadow-lg">
        <div class="mb-4">
            <span class="font-bold">Jenis Paket:</span>
            <span class="block text-xl">EXPERIENCE SEADOO PHOTO TRIP</span>
        </div>
        <div class="mb-4">
            <span class="font-bold">Identitas Pemesan</span>
            <p>Nama : {{ $booking->name }}</p>
            <p>No Telepon : {{ $booking->phone }}</p>
        </div>
        <p class="mb-4">Sudah menyetujui syarat dan ketentuan</p>

        <div class="text-center mt-4">
            <span class="text-xl font-bold">Total Harga: Rp. 1.900.000;</span>
        </div>

        <div class="mt-6 flex space-x-4">
            {{-- <a href="{{ route('booking1') }}"> --}}
                <button class="bg-gray-800 text-white px-4 py-2 rounded-lg">CARI PAKET LAIN</button>
            </a>
            <a href="{{ route('pembayaran.detail', ['id' => $booking->id]) }}">
                <button class="bg-purple-700 text-white px-4 py-2 rounded-lg">LANJUT KE PEMBAYARAN</button>
            </a>
        </div>
    </div>
</div>
@endsection
