@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center min-h-screen bg-gray-900">
    <div class="bg-gray-800 text-white p-8 rounded-lg shadow-lg w-96">
        <h1 class="text-center text-2xl mb-6 font-bold">BOOKING TICKET</h1>

        <form method="POST" action="{{ route('booking.store') }}">
            @csrf
            <div class="mb-4">
                <label class="block">Identitas Pemesan</label>
                <input type="text" name="name" class="w-full p-2 rounded bg-gray-700 text-white" placeholder="Nama" required>
            </div>
            <div class="mb-4">
                <label class="block">No. Telepon</label>
                <input type="text" name="phone" class="w-full p-2 rounded bg-gray-700 text-white" placeholder="No. Telepon" required>
            </div>
            <div class="mb-4">
                <label class="block">Jadwal Kedatangan (Check In)</label>
                <input type="date" name="date" class="w-full p-2 rounded bg-gray-700 text-white" required>
            </div>
            <div class="mb-4">
                <label class="block">Pilih Jam</label>
                <input type="time" name="time" class="w-full p-2 rounded bg-gray-700 text-white" required>
            </div>
            <div class="mb-4">
                <label class="block">Penumpang</label>
                <input type="number" name="passenger" class="w-full p-2 rounded bg-gray-700 text-white" placeholder="Masukkan Jumlah Penumpang" required>
            </div>
            <div class="mb-4 flex items-center">
                <input type="checkbox" name="include_drone" class="mr-2">
                <label>Include dengan Drone</label>
            </div>
            <button type="submit" class="bg-yellow-500 text-black w-full py-2 rounded">Selesai</button>
        </form>
    </div>
</div>
@endsection
