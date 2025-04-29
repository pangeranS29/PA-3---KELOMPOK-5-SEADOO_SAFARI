<x-app-layout>
    <x-slot name="title">Admin</x-slot>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            <a href="#!" onclick="window.history.go(-1); return false;">
                ←
            </a>
            {!! __('Booking &raquo; Edit Booking &raquo; #') . $booking->id . ' &middot; ' . $booking->name !!}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if ($errors->any())
                        <div class="mb-5" role="alert">
                            <div class="px-4 py-2 font-bold text-white bg-red-500 rounded-t">
                                Ada kesalahan!
                            </div>
                            <div class="px-4 py-3 text-red-700 bg-red-100 border border-t-0 border-red-400 rounded-b">
                                <p>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                </p>
                            </div>
                        </div>
                    @endif
                    <form class="w-full" action="{{ route('admin.bookings.update', $booking->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')


                        <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
                            <div class="w-full">
                                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                    for="grid-last-name">
                                    Nama
                                </label>
                                <input value="{{ old('name') ?? $booking->nama_customer }}" name="name"
                                    class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="grid-last-name" type="text" placeholder="Nama">
                                <div class="mt-2 text-sm text-gray-500">
                                    Nama booking. Contoh: Pangeran Silaen
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
                            <div class="w-full">
                                <label for="nama_paket" class="block text-sm font-medium text-gray-700">Nama Paket</label>
                                <input id="nama_paket" name="nama_paket" type="text"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    value="{{ $booking->detail_paket->pilihpaket->nama_paket }}" readonly>
                            </div>
                        </div>


                        <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
                            <div class="w-full">
                                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                    for="grid-last-name">
                                    Jumlah Penumpang
                                </label>
                                <input value="{{ old('jum;ah_penumpang') ?? $booking->jumlah_penumpang }}"
                                    name="jumlah_penumpang"
                                    class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="grid-last-name" type="text" placeholder="Nama">
                                <div class="mt-2 text-sm text-gray-500">
                                    Jumlah Penumpang. Contoh:1 ,2
                                </div>
                            </div>
                        </div>

                        {{-- Payment status dropdown --}}
                        <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
                            <div class="w-full">
                                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                    for="grid-last-name">
                                    Status Pembayaran
                                </label>
                                <select name="status_pembayaran"
                                    class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
                                    <option value="pending"
                                        {{ $booking->status_pembayaran == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="success"
                                        {{ $booking->status_pembayaran == 'success' ? 'selected' : '' }}>Success
                                    </option>
                                    <option value="failed"
                                        {{ $booking->status_pembayaran == 'failed' ? 'selected' : '' }}>Failed</option>
                                    <option value="expired"
                                        {{ $booking->status_pembayaran == 'expired' ? 'selected' : '' }}>Expired
                                    </option>
                                </select>
                                <div class="mt-2 text-sm text-gray-500">
                                    Status pembayaran booking. Contoh: Pending
                                </div>
                            </div>
                        </div>



                        <div class="flex flex-wrap mb-6 -mx-3">
                            <div class="w-full px-3 text-right">
                                <button type="submit"
                                    class="px-4 py-2 font-bold text-white bg-green-500 rounded shadow-lg hover:bg-green-700">
                                    Simpan Booking
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
