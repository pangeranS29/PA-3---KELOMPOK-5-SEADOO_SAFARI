<x-front-layout>
    <main class="flex flex-col md:flex-row justify-center items-start md:space-x-10 min-h-screen"
        style="background-color: #000000;">
        <div class="w-full max-w-6xl flex flex-col md:flex-row space-y-6 md:space-y-0 md:space-x-8 py-6">
            <!-- Sidebar -->
            <aside
                class="bg-gray-800 p-4 md:p-6 rounded-lg w-full md:w-64 flex-shrink-0 max-h-screen overflow-y-auto sticky top-0">
                <div class="text-center mb-4 md:mb-6">
                    <p class="font-bold text-sm md:text-base text-white">{{ Auth::user()->name }}</p>
                    <p class="text-xs md:text-base text-white">{{ Auth::user()->email }}</p>
                </div>
                <nav class="space-y-2 md:space-y-4">
                    <a href="{{ url('/account?tab=profile') }}"
                        class="flex items-center space-x-2 p-2 md:p-3 rounded-lg text-sm md:text-base {{ ($activeTab ?? '') === 'profile' ? 'bg-gray-600 text-white' : 'bg-gray-700 hover:bg-gray-600 text-white' }}">
                        <i class="fas fa-user"></i><span>Profile</span>
                    </a>
                    <a href="{{ url('/account?tab=transaction') }}"
                        class="flex items-center space-x-2 p-2 md:p-3 rounded-lg text-sm md:text-base {{ ($activeTab ?? '') === 'transaction' ? 'bg-gray-600 text-white' : 'bg-gray-700 hover:bg-gray-600 text-white' }}">
                        <i class="fas fa-box"></i><span>My Transaction</span>
                    </a>
                    <a href="{{ url('/account?tab=reset-password') }}"
                        class="flex items-center space-x-2 p-2 md:p-3 rounded-lg text-sm md:text-base {{ ($activeTab ?? '') === 'reset-password' ? 'bg-gray-600 text-white' : 'bg-gray-700 hover:bg-gray-600 text-white' }}">
                        <i class="fas fa-key"></i><span>Reset Password</span>
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="flex items-center space-x-2 p-2 md:p-3 rounded-lg bg-gray-700 hover:bg-gray-600 text-sm md:text-base text-white w-full text-left">
                            <i class="fas fa-power-off"></i><span>Logout</span>
                        </button>
                    </form>
                </nav>
            </aside>

            <!-- Main Content Section -->
            <section class="bg-gray-800 p-4 md:p-6 rounded-lg w-full space-y-4 md:space-y-6">
                @if (($activeTab ?? '') === 'transaction')
                    <h2 class="text-white text-xl font-semibold">My Transaction</h2>
                    <div class="space-y-4 md:space-y-6">
                        @forelse ($bookings as $booking)
                            <div
                                class="bg-gray-700 p-3 md:p-4 rounded-lg flex flex-col md:flex-row justify-between gap-3 md:gap-4">
                                <div class="flex items-center space-x-3 md:space-x-4">
                                    <img alt="Paket Image" class="h-8 md:h-12 rounded-full" height="50"
                                        src="{{ $booking->detail_paket->thumbnail ?? asset('images/default.jpg') }}"
                                        width="50" />
                                    <div>
                                        <p class="font-semibold text-sm md:text-base text-white">
                                            {{ $booking->detail_paket->pilihpaket->nama_paket ?? 'Nama Paket Tidak Tersedia' }}
                                        </p>
                                        <p class="text-xs md:text-base text-white">
                                            {{ $booking->waktu_mulai }} - {{ $booking->waktu_selesai }}
                                        </p>
                                    </div>
                                </div>
                                <div
                                    class="flex flex-col md:flex-row items-start md:items-center space-y-2 md:space-y-0 md:space-x-3 lg:space-x-4">
                                    @if ($booking->status_pembayaran === 'pending' && now()->lessThanOrEqualTo($booking->waktu_selesai))
                                        <a href="{{ route('front.payment', $booking->id) }}"
                                            class="bg-blue-500 text-white py-1 px-3 rounded-lg text-sm">Pay Now</a>
                                    @elseif ($booking->status_pembayaran === 'pending' && now()->greaterThan($booking->waktu_selesai))
                                        <span class="bg-red-500 text-white py-1 px-3 rounded-lg text-sm">Expired</span>
                                    @elseif ($booking->status_pembayaran === 'success')
                                        <span class="bg-green-500 text-white py-1 px-3 rounded-lg text-sm">Paid</span>
                                    @endif
                                    <div class="text-xs md:text-base text-white">
                                        <p>Order ID</p>
                                        <p class="font-semibold truncate">{{ $booking->id }}</p>
                                    </div>
                                    <a href="{{ route('front.cetak.resi', $booking->id) }}"
                                        class="text-yellow-500 hover:underline text-xs md:text-base whitespace-nowrap"
                                        target="_blank" rel="noopener">
                                        Cetak Resi
                                    </a>

                                </div>
                            </div>
                        @empty
                            <p class="text-white">Belum ada transaksi.</p>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $bookings->appends(request()->query())->links() }}
                    </div>
                @elseif (($activeTab ?? '') === 'reset-password')
                    <h2 class="text-white text-xl font-semibold">Reset Password</h2>
                    <!-- Form reset password -->
                @elseif (($activeTab ?? '') === 'profile')
                    <h2 class="text-white text-xl font-semibold">Profile</h2>
                    <!-- Konten profil -->
                @else
                    <p class="text-red-500">Tab tidak ditemukan.</p>
                @endif
            </section>
        </div>
    </main>
</x-front-layout>
