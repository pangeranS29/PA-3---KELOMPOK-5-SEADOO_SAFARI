@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen mt-20 bg-gray-100">
    <div class="max-w-4xl w-full bg-white p-8 border border-gray-300 rounded-lg shadow-xl">
        <h1 class="text-3xl font-bold mb-4 text-gray-800">Halo, {{ $booking->name }}!</h1>
        <p class="mb-6 text-gray-600">Berikut adalah <span class="font-bold text-gray-900">rincian pembayaran</span> untuk pemesanan jetski Anda.</p>

        <div class="border-t border-gray-300 pt-4 pb-4">
            <div class="flex justify-between mb-4">
                <div>
                    <p class="font-bold text-gray-700">ID Pemesanan :</p>
                    <p class="text-gray-600">{{ $booking->id }}</p>
                </div>
                <div>
                    <p class="font-bold text-gray-700">Dipesan pada :</p>
                    <p class="text-gray-600">{{ $booking->created_at->format('d M Y, H:i') }}</p>
                </div>
            </div>
        </div>

        <div class="border-t border-gray-300 pt-4 pb-4">
            <div class="flex justify-between mb-4">
                <div>
                    <p class="font-bold text-gray-700">PEMESAN</p>
                    <p class="text-gray-600">{{ $booking->name }}</p>
                    <p class="text-gray-600">{{ $booking->phone }}</p>
                </div>
                <div>
                    <p class="font-bold text-gray-700">Safari Package</p>
                    <p class="text-gray-600">Photo Trip</p>
                </div>
            </div>
        </div>

        <div class="border-t border-gray-300 pt-4 pb-4">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-200 text-gray-800">
                        <th class="py-2 px-4 text-left">Deskripsi</th>
                        <th class="py-2 px-4 text-center">Harga per Item</th>
                        <th class="py-2 px-4 text-center">Jumlah</th>
                        <th class="py-2 px-4 text-right">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-gray-300">
                        <td class="py-3 px-4">Self Ride</td>
                        <td class="py-3 px-4 text-center">Rp {{ number_format(900000, 2, ',', '.') }}</td>
                        <td class="py-3 px-4 text-center">1</td>
                        <td class="py-3 px-4 text-right text-blue-600">Rp {{ number_format(900000, 2, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="border-t border-gray-300 pt-4 pb-4 flex justify-end">
            <p class="text-xl font-bold text-gray-800">Total Pembayaran: <span class="text-green-600">Rp {{ number_format(900000, 2, ',', '.') }}</span></p>
        </div>

        <div class="mt-6">
            <a href="{{ route('pembayaran.proses', ['id' => $booking->id]) }}" class="block w-full">
                <button class="w-full bg-purple-700 hover:bg-purple-800 text-white py-3 font-bold text-lg rounded-lg shadow-md transition duration-300">BAYAR SEKARANG</button>
            </a>

            </a>
        </div>
    </div>
</div>
@endsection
