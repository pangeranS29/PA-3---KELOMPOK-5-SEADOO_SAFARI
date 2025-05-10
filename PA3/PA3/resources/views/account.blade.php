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
                                        src="{{ $booking->detail_paket->thumbnail ?? asset('images/default.jpg') }} "
                                        width="50" />
                                    <div>
                                        <p class="font-semibold text-sm md:text-base text-white">
                                            {{ $booking->detail_paket->pilihpaket->nama_paket ?? 'Nama Paket Tidak Tersedia' }}
                                        </p>
                                        <p class="text-xs md:text-base text-white">
                                            {{ Carbon\Carbon::parse($booking->waktu_mulai)->translatedFormat('d F Y, H:i') }}
                                            -
                                            {{ Carbon\Carbon::parse($booking->waktu_selesai)->translatedFormat('d F Y, H:i') }}
                                        </p>
                                    </div>
                                </div>
                                <div
                                    class="flex flex-col md:flex-row items-start md:items-center space-y-2 md:space-y-0 md:space-x-3 lg:space-x-4">

                                    {{-- Status Pembayaran --}}
                                    @if ($booking->status_pembayaran === 'pending' && $booking->metode_pembayaran && empty($booking->bukti_pembayaran))
                                        <a href="{{ route('front.payment.show', $booking->id) }}"
                                            class="bg-blue-500 text-white py-1 px-3 rounded-lg text-sm">Lanjutkan
                                            Pembayaran</a>
                                    @elseif ($booking->status_pembayaran === 'pending')
                                        <a href="{{ route('front.payment', $booking->id) }}"
                                            class="bg-blue-500 text-white py-1 px-3 rounded-lg text-sm">Bayar
                                            Sekarang</a>
                                    @elseif ($booking->status_pembayaran === 'menunggu_konfirmasi')
                                        <span class="bg-yellow-500 text-white py-1 px-3 rounded-lg text-sm">Menunggu
                                            Konfirmasi</span>
                                    @elseif ($booking->status_pembayaran === 'expired')
                                        <span
                                            class="bg-red-500 text-white py-1 px-3 rounded-lg text-sm">Kadaluarsa</span>
                                    @elseif ($booking->status_pembayaran === 'success')
                                        <span class="bg-green-500 text-white py-1 px-3 rounded-lg text-sm">Lunas</span>
                                    @elseif ($booking->status_pembayaran === 'rejected')
                                        <a href="{{ route('front.payment', $booking->id) }}"
                                            class="bg-blue-500 text-white py-1 px-3 rounded-lg text-sm">Bayar
                                            Kembali</a>
                                    @endif

                                    {{-- ID Pesanan --}}
                                    <div class="text-xs md:text-base text-white">
                                        <p>ID Pesanan</p>
                                        <p class="font-semibold truncate">{{ $booking->id }}</p>
                                    </div>

                                    {{-- Cetak Resi --}}
                                    @php
                                        $isExpired = $booking->status_pembayaran === 'expired';
                                    @endphp

                                    @if ($booking->status_pembayaran === 'success')
                                        <a href="{{ route('front.cetak.resi', $booking->id) }}"
                                            class="text-yellow-500 hover:underline text-xs md:text-base whitespace-nowrap"
                                            target="_blank" rel="noopener">
                                            Cetak Resi
                                        </a>
                                    @elseif ($isExpired)
                                        <span
                                            class="text-gray-400 text-xs md:text-base whitespace-nowrap cursor-not-allowed"
                                            title="Resi tidak tersedia karena status kadaluarsa">
                                            Cetak Resi
                                        </span>
                                    @else
                                        <span
                                            class="text-gray-400 text-xs md:text-base whitespace-nowrap cursor-not-allowed"
                                            title="Resi hanya tersedia untuk pembayaran yang sudah berhasil">
                                            Cetak Resi
                                        </span>
                                    @endif

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
                    <form action="{{ route('front.account.reset-password') }}" method="POST" id="resetPasswordForm"
                        class="space-y-4 mt-4">
                        @csrf
                        <div>
                            <label class="block mb-1 text-sm text-white" for="current_password">Password Saat
                                Ini</label>
                            <input class="w-full p-2 rounded bg-gray-800 border border-gray-600 text-sm text-white"
                                id="current_password" type="password" name="current_password" required />
                        </div>

                        <div>
                            <label class="block mb-1 text-sm text-white" for="new_password">Password Baru</label>
                            <input class="w-full p-2 rounded bg-gray-800 border border-gray-600 text-sm text-white"
                                id="new_password" type="password" name="new_password" required />
                        </div>

                        <div>
                            <label class="block mb-1 text-sm text-white" for="new_password_confirmation">Konfirmasi
                                Password Baru</label>
                            <input class="w-full p-2 rounded bg-gray-800 border border-gray-600 text-sm text-white"
                                id="new_password_confirmation" type="password" name="new_password_confirmation"
                                required />
                        </div>

                        <button type="submit" class="mt-3 p-2 bg-yellow-500 text-black rounded text-sm">
                            Reset Password
                        </button>
                    </form>
                @elseif (($activeTab ?? '') === 'profile')
                    <h2 class="text-white text-xl font-semibold">Account Details</h2>
                    <section class="bg-gray-700 p-4 md:p-8 rounded-lg w-full space-y-4 md:space-y-6">

                        <!-- Edit Profile Form -->
                        <form action="{{ route('front.account.update') }}" method="POST"
                            class="space-y-3 md:space-y-4">
                            @csrf
                            @method('PUT')

                            <div>
                                <label class="block mb-1 text-sm text-white" for="name">Name</label>
                                <input class="w-full p-2 rounded bg-gray-800 border border-gray-600 text-sm text-white"
                                    id="name" type="text" name="name" value="{{ Auth::user()->name }}" />
                            </div>

                            <div>
                                <label class="block mb-1 text-sm text-white" for="email">E-mail</label>
                                <input class="w-full p-2 rounded bg-gray-800 border border-gray-600 text-sm text-white"
                                    id="email" type="email" name="email" value="{{ Auth::user()->email }}" />
                            </div>

                            <div>
                                <label class="block mb-1 text-sm text-white" for="phone">Phone Number</label>
                                <input class="w-full p-2 rounded bg-gray-800 border border-gray-600 text-sm text-white"
                                    id="phone" type="tel" name="phone"
                                    value="{{ Auth::user()->phone }}" />
                            </div>

                            <div class="flex justify-between items-center">
                                <button type="submit"
                                    class="mt-3 md:mt-4 p-2 bg-yellow-500 text-black rounded text-sm md:text-base">
                                    Update Profile
                                </button>
                            </div>
                        </form>
                    </section>
                @else
                    <p class="text-red-500">Tab tidak ditemukan.</p>
                @endif
            </section>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tangkap form update profile
            const updateForm = document.querySelector('form[action="{{ route('front.account.update') }}"]');

            if (updateForm) {
                updateForm.addEventListener('submit', function(e) {
                    e.preventDefault();

                    // Ambil nilai form
                    const name = document.getElementById('name').value;
                    const email = document.getElementById('email').value;
                    const phone = document.getElementById('phone').value;

                    // Show confirmation dialog
                    Swal.fire({
                        title: 'Konfirmasi Update Profile',
                        html: `
                <div class="text-left">
                    <p class="mb-2"><strong>Nama:</strong> ${name}</p>
                    <p class="mb-2"><strong>Email:</strong> ${email}</p>
                    <p class="mb-2"><strong>Nomor Telepon:</strong> ${phone || '-'}</p>
                </div>
                `,
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#f59e0b',
                        cancelButtonColor: '#6b7280',
                        confirmButtonText: 'Ya, Update Profile',
                        cancelButtonText: 'Periksa Kembali',
                        backdrop: `
                rgba(0,0,0,0.7)
                left top
                no-repeat
                `
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Show loading indicator
                            Swal.fire({
                                title: 'Memproses Update',
                                html: 'Mohon tunggu sebentar...',
                                allowOutsideClick: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                    // Submit form secara manual setelah konfirmasi
                                    updateForm.submit();
                                }
                            });
                        }
                    });
                });
            }
        });

        document.getElementById('resetPasswordForm').addEventListener('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Reset Password?',
                text: "Anda yakin ingin mengubah password?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#f59e0b',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Reset Password',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Tampilkan loading
                    Swal.fire({
                        title: 'Memproses Update',
                        html: 'Mohon tunggu sebentar...',
                        didOpen: () => {
                            Swal.showLoading();
                            // Submit form setelah konfirmasi
                            e.target.submit();
                        }
                    });
                }
            });
        });
    </script>
</x-front-layout>
