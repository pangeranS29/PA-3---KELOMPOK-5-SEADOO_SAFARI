<div class="py-8 px-4">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Stats Cards Row -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Total Bookings Card -->
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl shadow-lg overflow-hidden">
                <div class="p-6 flex items-center">
                    <div class="mr-4">
                        <div class="bg-white bg-opacity-20 rounded-full p-3">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <p class="text-white text-sm font-medium">Total Bookings</p>
                        <h3 class="text-white text-2xl font-bold">{{ $totalBookings }}</h3>
                        <p class="text-blue-100 text-xs mt-1">+{{ $bookingIncrease }}% from last month</p>
                    </div>
                </div>
            </div>

            <!-- Revenue Card -->
            <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl shadow-lg overflow-hidden">
                <div class="p-6 flex items-center">
                    <div class="mr-4">
                        <div class="bg-white bg-opacity-20 rounded-full p-3">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <p class="text-white text-sm font-medium">Total Revenue</p>
                        <h3 class="text-white text-2xl font-bold">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
                        <p class="text-purple-100 text-xs mt-1">+{{ $revenueIncrease }}% from last month</p>
                    </div>
                </div>
            </div>

            <!-- Users Card -->
            <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-xl shadow-lg overflow-hidden">
                <div class="p-6 flex items-center">
                    <div class="mr-4">
                        <div class="bg-white bg-opacity-20 rounded-full p-3">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <p class="text-white text-sm font-medium">Registered Users</p>
                        <h3 class="text-white text-2xl font-bold">{{ $totalUsers }}</h3>
                        <p class="text-green-100 text-xs mt-1">+{{ $userIncrease }} new this month</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts and Recent Bookings Row -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <!-- Bookings Chart -->
            <div class="lg:col-span-2 bg-white rounded-xl shadow-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Monthly Bookings</h3>
                    <select class="text-sm border-gray-300 rounded-md focus:border-blue-500 focus:ring-blue-500">
                        <option>Last 6 Months</option>
                        <option>This Year</option>
                        <option>Last Year</option>
                    </select>
                </div>
                <div class="h-64">
                    <canvas id="bookingsChart"></canvas>
                </div>
            </div>

            <!-- Recent Bookings -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Recent Bookings</h3>
                    <div class="space-y-4">
                        @foreach($recentBookings as $booking)
                        <div class="flex items-start">
                            <div class="flex-shrink-0 bg-blue-100 rounded-md p-2">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">{{ $booking->user->name }}</p>
                                <p class="text-sm text-gray-500">{{ $booking->detail_paket->pilihpaket->nama_paket }}</p>
                                <p class="text-xs text-gray-400">{{ $booking->waktu_mulai->format('d M Y, H:i') }}</p>
                            </div>
                            <div class="ml-auto">
                                <span class="px-2 py-1 text-xs rounded-full {{ $booking->status_pembayaran === 'success' ? 'bg-green-100 text-green-800' : ($booking->status_pembayaran === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                    {{ $booking->status_pembayaran }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Full Width Table -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800">Latest Bookings</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Package</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Passengers</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($latestBookings as $booking)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full" src="{{ $booking->user->profile_photo_url }}" alt="">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $booking->user->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $booking->user->phone }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $booking->detail_paket->pilihpaket->nama_paket }}</div>
                                <div class="text-sm text-gray-500">{{ $booking->detail_paket->pilihpaket->durasi }} hours</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $booking->waktu_mulai->format('d M Y') }}</div>
                                <div class="text-sm text-gray-500">{{ $booking->waktu_mulai->format('H:i') }} - {{ $booking->waktu_selesai->format('H:i') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $booking->jumlah_penumpang }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs rounded-full {{ $booking->status_pembayaran === 'success' ? 'bg-green-100 text-green-800' : ($booking->status_pembayaran === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                    {{ $booking->status_pembayaran }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                Rp {{ number_format($booking->total_harga, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('admin.bookings.show', $booking->id) }}" class="text-blue-600 hover:text-blue-900 mr-3">View</a>
                                <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-gray-200">
                <a href="{{ route('admin.bookings.index') }}" class="text-blue-600 hover:text-blue-900 font-medium">View all bookings →</a>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Bookings Chart
            const bookingsCtx = document.getElementById('bookingsChart').getContext('2d');
            const bookingsChart = new Chart(bookingsCtx, {
                type: 'line',
                data: {
                    labels: @json($bookingMonths),
                    datasets: [{
                        label: 'Bookings',
                        data: @json($bookingData),
                        backgroundColor: 'rgba(59, 130, 246, 0.05)',
                        borderColor: 'rgba(59, 130, 246, 1)',
                        borderWidth: 2,
                        tension: 0.1,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                drawBorder: false
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        });
    </script>
@endpush
