<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dasbor Admin') }}
        </h2>
    </x-slot>
    <div class="py-8 px-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Kartu Statistik -->
        <div class="flex flex-wrap -mx-4 mb-8">
            <!-- Total Pemesanan -->
            <div class="w-full md:w-1/2 lg:w-1/4 px-4 mb-4">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl shadow-lg overflow-hidden h-full">
                    <div class="p-6 flex items-center h-full">
                        <div class="mr-4">
                            <div class="bg-white bg-opacity-20 rounded-full p-3">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <p class="text-white text-sm font-medium">Total Pemesanan</p>
                            <h3 class="text-white text-2xl font-bold">{{ $totalBookings }}</h3>
                            <p class="text-blue-100 text-xs mt-1">+{{ $bookingIncrease }}% dari bulan lalu</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pendapatan -->
            <div class="w-full md:w-1/2 lg:w-1/4 px-4 mb-4">
                <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl shadow-lg overflow-hidden h-full">
                    <div class="p-6 flex items-center h-full">
                        <div class="mr-4">
                            <div class="bg-white bg-opacity-20 rounded-full p-3">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <p class="text-white text-sm font-medium">Pendapatan Total</p>
                            <h3 class="text-white text-xl font-bold">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
                            <p class="text-purple-100 text-xs mt-1">+{{ $revenueIncrease }}% dari bulan lalu</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pengguna -->
            <div class="w-full md:w-1/2 lg:w-1/4 px-4 mb-4">
                <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-xl shadow-lg overflow-hidden h-full">
                    <div class="p-6 flex items-center h-full">
                        <div class="mr-4">
                            <div class="bg-white bg-opacity-20 rounded-full p-3">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <p class="text-white text-sm font-medium">Pengguna Terdaftar</p>
                            <h3 class="text-white text-2xl font-bold">{{ $totalUsers }}</h3>
                            <p class="text-green-100 text-xs mt-1">+{{ $userIncrease }} baru bulan ini</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Jetski Available -->
            <div class="w-full md:w-1/2 lg:w-1/4 px-4 mb-4">
                <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-xl shadow-lg overflow-hidden h-full">
                    <div class="p-6 flex items-center h-full">
                        <div class="mr-4">
                            <div class="bg-white bg-opacity-20 rounded-full p-3">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <p class="text-white text-sm font-medium">Jetski Tersedia</p>
                            <h3 class="text-white text-2xl font-bold">{{ $availableJetskis }} / 15</h3>
                            <p class="text-yellow-100 text-xs mt-1">{{ $bookedJetskisToday }} sudah dipesan hari ini</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


            <!-- Search and Filter -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
                <div class="px-6 py-4">
                    <form method="GET" action="{{ route('admin.dashboard') }}"
                        class="flex flex-col md:flex-row gap-4">
                        <div class="flex-1 relative">
                            <label for="search" class="sr-only">Search</label>
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input type="text" name="search" id="search" value="{{ $search }}"
                                class="w-full pl-10 p-3 rounded-lg border border-gray-300 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-500/50 transition"
                                placeholder="Cari nama, email, telepon, atau paket...">
                        </div>

                        <div class="relative">
                            <label for="date_filter" class="sr-only">Tanggal</label>
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <input type="date" name="date_filter" id="date_filter" value="{{ $dateFilter }}"
                                class="pl-10 w-full p-3 rounded-lg border border-gray-300 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-500/50 transition"
                                x-data="{
                                    lastValue: '',
                                    init() {
                                        this.$el.addEventListener('change', (e) => {
                                            if (e.target.value === this.lastValue) {
                                                // Jika tanggal yang sama diklik dua kali
                                                window.location.href = '{{ route('admin.dashboard') }}?date_filter=' + e.target.value;
                                            }
                                            this.lastValue = e.target.value;
                                        });
                                    }
                                }">
                        </div>

                        <button type="submit"
                            class="bg-yellow-500 hover:bg-yellow-600 text-white font-medium py-3 px-6 rounded-lg transition flex items-center justify-center">
                            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Filter
                        </button>

                        <a href="{{ route('admin.dashboard') }}"
                            class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-3 px-6 rounded-lg transition flex items-center justify-center">
                            Reset
                        </a>
                    </form>
                </div>
            </div>

            <!-- Tabel Pemesanan Hari Ini -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-800">Pemesanan Hari Ini
                        ({{ \Carbon\Carbon::parse($dateFilter)->translatedFormat('d F Y') }})</h3>
                    <span
                        class="px-3 py-1 bg-{{ $availableJetskis > 0 ? 'green' : 'red' }}-100 text-{{ $availableJetskis > 0 ? 'green' : 'red' }}-800 text-sm rounded-full">
                        {{ $availableJetskis > 0 ? 'Masih tersedia ' . $availableJetskis . ' jetski' : 'Jetski penuh hari ini' }}
                    </span>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Pelanggan</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Paket</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Waktu</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Penumpang</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Jumlah</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Jetski</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($todayBookings as $booking)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-full"
                                                    src="{{ $booking->user->profile_photo_url }}" alt="">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $booking->user->name }}</div>
                                                <div class="text-sm text-gray-500">{{ $booking->user->phone }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            {{ $booking->detail_paket->pilihpaket->nama_paket }}</div>
                                        <div class="text-sm text-gray-500">
                                            {{ $booking->detail_paket->pilihpaket->durasi }} menit</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $booking->waktu_mulai->format('H:i') }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $booking->waktu_selesai->format('H:i') }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $booking->jumlah_penumpang }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $status = $booking->status_pembayaran;
                                            $class = '';
                                            $label = '';

                                            switch ($status) {
                                                case 'success':
                                                    $class = 'bg-green-100 text-green-800';
                                                    $label = 'Berhasil';
                                                    break;
                                                case 'pending':
                                                    $class = 'bg-gray-100 text-gray-800';
                                                    $label = 'Tertunda';
                                                    break;
                                                case 'menunggu_konfirmasi':
                                                    $class = 'bg-yellow-100 text-yellow-800';
                                                    $label = 'Menunggu Konfirmasi';
                                                    break;
                                                case 'canceled':
                                                    $class = 'bg-yellow-100 text-yellow-800';
                                                    $label = 'Dibatalkan';
                                                    break;
                                                case 'expired':
                                                    $class = 'bg-red-100 text-red-800';
                                                    $label = 'Kedaluwarsa';
                                                    break;
                                                case 'rejected':
                                                    $class = 'bg-red-100 text-red-800';
                                                    $label = 'Ditolak';
                                                    break;
                                                default:
                                                    $class = 'bg-gray-100 text-gray-800';
                                                    $label = ucfirst($status);
                                                    break;
                                            }
                                        @endphp
                                        <span
                                            class="px-2 py-1 text-xs rounded-full {{ $class }}">{{ $label }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        Rp {{ number_format($booking->total_harga, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        #{{ $booking->id }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">
                                        Tidak ada pemesanan untuk hari ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
