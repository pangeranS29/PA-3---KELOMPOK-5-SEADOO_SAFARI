<x-front-layout>
    <main class="min-h-screen bg-gradient-to-b from-gray-900 to-gray-800 pt-20 pb-10">
        <div class="container mx-auto px-4">
            <div class="max-w-5xl mx-auto flex flex-col lg:flex-row gap-8">
                <!-- Kolom Kiri - Ringkasan Booking -->
                <div class="lg:w-1/3">
                    <div class="bg-gray-800 rounded-xl shadow-2xl overflow-hidden sticky top-28">
                        <div class="relative">
                            <img src="{{ $booking->detail_paket->thumbnail }}"
                                alt="{{ $booking->detail_paket->pilihpaket->nama_paket }}"
                                class="w-full h-48 object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                            <div class="absolute bottom-4 left-4">
                                <h2 class="text-white text-xl font-bold">
                                    {{ $booking->detail_paket->pilihpaket->nama_paket }}
                                </h2>
                            </div>
                        </div>

                        <div class="p-6">
                            <div class="space-y-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-300">Tanggal:</span>
                                    <span class="text-white font-medium">
                                        {{ \Carbon\Carbon::parse($booking->waktu_mulai)->translatedFormat('d F Y') }}
                                    </span>
                                </div>

                                <div class="flex justify-between items-center">
                                    <span class="text-gray-300">Waktu:</span>
                                    <span class="text-white font-medium">
                                        {{ \Carbon\Carbon::parse($booking->waktu_mulai)->format('H:i') }} -
                                        {{ \Carbon\Carbon::parse($booking->waktu_selesai)->format('H:i') }}
                                    </span>
                                </div>

                                <div class="flex justify-between items-center">
                                    <span class="text-gray-300">Jumlah Penumpang:</span>
                                    <span class="text-white font-medium">{{ $booking->jumlah_penumpang }}</span>
                                </div>

                                <div class="flex justify-between items-center mb-4">
                                    <span class="text-gray-300">Harga Paket:</span>
                                    <span class="text-white font-medium">Rp
                                        {{ number_format($booking->detail_paket->pilihpaket->harga, 0, ',', '.') }}</span>
                                </div>

                                @if ($booking->harga_drone > 0)
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-300">Tambahan Drone:</span>
                                        <span class="text-yellow-400 font-medium">
                                            + Rp {{ number_format($booking->harga_drone, 0, ',', '.') }}
                                        </span>
                                    </div>
                                @endif
                            </div>

                            <div class="border-t border-gray-700 pt-4 mt-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-300 font-medium">Total Pembayaran:</span>
                                    <span class="text-yellow-400 text-l font-bold">
                                        Rp {{ number_format($booking->total_harga, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan - Form Pembayaran -->
                <div class="lg:w-2/3">
                    <div class="bg-gray-800 rounded-xl shadow-2xl overflow-hidden">
                        <div class="bg-gradient-to-r from-yellow-500 to-yellow-400 p-4">
                            <h1 class="text-black text-2xl font-bold">PEMBAYARAN</h1>
                        </div>

                        <div class="p-6">
                            {{-- Flash Message --}}
                            @if (session('success'))
                                <div class="bg-green-500 text-white p-4 rounded mb-6">
                                    {{ session('success') }}
                                </div>
                            @endif

                            {{-- Booking Info --}}
                            <div class="mb-8">
                                <h2 class="text-white text-lg font-semibold mb-4 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Detail Booking
                                </h2>

                                <div class="bg-gray-700/50 rounded-lg p-4 border border-gray-600">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-white">
                                        <div>
                                            <p class="text-gray-400 text-sm">Nama Pemesan</p>
                                            <p class="font-medium">{{ $booking->nama_customer }}</p>
                                        </div>
                                        <div>
                                            <p class="text-gray-400 text-sm">No. Telepon</p>
                                            <p class="font-medium">{{ $booking->no_telepon }}</p>
                                        </div>
                                        <div>
                                            <p class="text-gray-400 text-sm">Paket</p>
                                            <p class="font-medium">{{ $booking->detail_paket->pilihpaket->nama_paket }}
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-gray-400 text-sm">Durasi</p>
                                            <p class="font-medium">{{ $booking->detail_paket->pilihpaket->durasi }}
                                                Menit</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Payment Status --}}
                            @switch($booking->status_pembayaran)
                                @case('expire')
                                    <div class="bg-red-600 text-white p-4 rounded mb-6">
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <span>Pembayaran Anda <strong>kadaluarsa</strong>. Silakan lakukan pemesanan
                                                ulang.</span>
                                        </div>
                                    </div>
                                    <a href="{{ route('front.index') }}"
                                        class="block text-center bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 px-4 rounded-lg transition">
                                        Booking Ulang
                                    </a>
                                @break

                                @case('settlement')
                                    <div class="bg-green-500 text-white p-4 rounded mb-6">
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <span>Pembayaran Anda <strong>berhasil</strong>.</span>
                                        </div>
                                    </div>
                                @break

                                @default
                                    @if ($booking->metode_pembayaran === 'midtrans' && $booking->url_pembayaran)
                                        <div class="bg-yellow-400 text-black p-4 rounded mb-6">
                                            <div class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                                    fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                <span>Pembayaran Anda belum selesai. Silakan lanjutkan melalui tombol di bawah
                                                    ini.</span>
                                            </div>
                                        </div>

                                        <div class="flex flex-col gap-3">
                                            <a href="{{ $booking->url_pembayaran }}" target="_blank"
                                                class="bg-yellow-500 hover:bg-yellow-400 text-black font-semibold py-3 px-4 rounded-lg transition text-center">
                                                Lanjutkan Pembayaran
                                            </a>
                                            <a href="{{ route('front.payment.cancel', $booking->id) }}"
                                                onclick="return confirm('Apakah Anda yakin ingin membatalkan pembayaran ini?');"
                                                class="bg-red-600 hover:bg-red-500 text-white font-semibold py-3 px-4 rounded-lg transition text-center">
                                                Batalkan Pembayaran
                                            </a>
                                        </div>
                                    @else
                                        <!-- Pilih Metode Pembayaran -->
                                        <form action="{{ route('front.payment.update', $booking->id) }}" method="POST"
                                            id="payment-form">
                                            @csrf

                                            <div class="mb-6">
                                                <h2 class="text-white text-lg font-semibold mb-4 flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" />
                                                        <path fill-rule="evenodd"
                                                            d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    Pilih Metode Pembayaran
                                                </h2>

                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                    <!-- Manual Transfer -->
                                                    <div class="relative">
                                                        <input type="radio" id="manual_transfer" name="metode_pembayaran"
                                                            value="manual_transfer"
                                                            class="peer absolute inset-0 opacity-0 cursor-pointer" required
                                                            onclick="showPaymentInstruction('manual_transfer')">
                                                        <label for="manual_transfer"
                                                            class="flex flex-col items-center justify-center bg-gray-700 border-2 border-gray-600 rounded-xl p-4 hover:border-yellow-400 peer-checked:border-yellow-400 peer-checked:ring-2 peer-checked:ring-yellow-400/50 transition-all">
                                                            <img src="{{ asset('svgs/bank.svg') }}" alt="Manual Transfer"
                                                                class="h-10 mb-2">
                                                            <span class="text-white font-medium">Transfer Bank</span>
                                                            <span class="text-gray-400 text-xs">BRI / Bank SUMUT</span>
                                                        </label>
                                                    </div>

                                                    <!-- QRIS -->
                                                    {{-- <div class="relative">
                                                        <input type="radio" id="qris" name="metode_pembayaran" value="qris"
                                                            class="peer absolute inset-0 opacity-0 cursor-pointer" required
                                                            onclick="showPaymentInstruction('qris')">
                                                        <label for="qris"
                                                            class="flex flex-col items-center justify-center bg-gray-700 border-2 border-gray-600 rounded-xl p-4 hover:border-yellow-400 peer-checked:border-yellow-400 peer-checked:ring-2 peer-checked:ring-yellow-400/50 transition-all">
                                                            <img src="{{ asset('svgs/qris.svg') }}" alt="QRIS" class="h-10 mb-2">
                                                            <span class="text-white font-medium">QRIS</span>
                                                            <span class="text-gray-400 text-xs">Scan QR Code</span>
                                                        </label>
                                                    </div> --}}
                                                </div>
                                            </div>

                                            <!-- Payment Instruction -->
                                            <div id="payment-instruction"
                                                class="hidden mb-6 bg-gray-700/50 rounded-lg p-4 border border-gray-600">
                                                <!-- JavaScript will fill this -->
                                            </div>

                                            <button type="submit"
                                                class="w-full bg-gradient-to-r from-yellow-500 to-yellow-400 hover:from-yellow-400 hover:to-yellow-300 text-black font-bold py-3 px-4 rounded-lg shadow-lg transition-all transform hover:scale-[1.01]">
                                                Pilih dan Lanjutkan
                                            </button>
                                        </form>
                                    @endif
                            @endswitch
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Show SweetAlert when payment proof is uploaded
        @if (session('payment_proof_uploaded'))
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Bukti Pembayaran Terkirim!',
                    html: `
                        <div class="text-left">
                            <p class="mb-2">Terima kasih telah mengupload bukti pembayaran.</p>
                            <p class="mb-2">Pesanan Anda akan segera kami verifikasi.</p>
                            <div class="bg-gray-100 p-3 rounded-lg mt-4 text-gray-800">
                                <p class="font-semibold">Detail Pesanan:</p>
                                <p>No. Booking: <strong>{{ $booking->id }}</strong></p>
                                <p>Total Pembayaran: <strong>Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</strong></p>
                            </div>
                        </div>
                    `,
                    icon: 'success',
                    confirmButtonColor: '#f59e0b',
                    confirmButtonText: 'Mengerti',
                    backdrop: `
                        rgba(0,0,0,0.7)
                        url("{{ asset('images/loading.gif') }}")
                        left top
                        no-repeat
                    `
                });
            });
        @endif

        // Show confirmation when cancel button is clicked
        document.querySelectorAll('[onclick*="confirm"]').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const href = this.getAttribute('href');

                Swal.fire({
                    title: 'Batalkan Pembayaran?',
                    text: "Anda yakin ingin membatalkan pembayaran ini?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#f59e0b',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, Batalkan',
                    cancelButtonText: 'Kembali'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = href;
                    }
                });
            });
        });

        // Show payment method selection confirmation
        document.getElementById('payment-form')?.addEventListener('submit', function(e) {
            e.preventDefault();
            const form = this;
            const method = document.querySelector('input[name="metode_pembayaran"]:checked')?.value;

            if (!method) {
                Swal.fire({
                    title: 'Peringatan',
                    text: 'Silakan pilih metode pembayaran terlebih dahulu',
                    icon: 'warning',
                    confirmButtonColor: '#f59e0b'
                });
                return;
            }

            let methodName = '';
            let instructions = '';

            if (method === 'manual_transfer') {
                methodName = 'Transfer Bank';
                instructions = `
                    <div class="text-left">
                        <p class="mb-2">Anda akan diarahkan untuk mengupload bukti transfer.</p>
                        <p class="text-sm text-yellow-400">Pastikan transfer sesuai dengan nominal yang tertera.</p>
                    </div>
                `;
            } else if (method === 'qris') {
                methodName = 'QRIS';
                instructions = `
                    <div class="text-left">
                        <p class="mb-2">Anda akan diarahkan ke halaman pembayaran QRIS.</p>
                        <p class="text-sm text-yellow-400">Pastikan saldo e-wallet/m-banking Anda mencukupi.</p>
                    </div>
                `;
            }

            Swal.fire({
                title: 'Konfirmasi Metode Pembayaran',
                html: `
                    <div class="text-left">
                        <p class="mb-2">Anda memilih: <strong>${methodName}</strong></p>
                        ${instructions}
                        <div class="bg-gray-700 p-3 rounded-lg mt-4 text-white">
                            <p class="font-semibold">Total Pembayaran:</p>
                            <p class="text-xl">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</p>
                        </div>
                    </div>
                `,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#f59e0b',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Lanjutkan',
                cancelButtonText: 'Batalkan'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading indicator
                    Swal.fire({
                        title: 'Memproses...',
                        html: 'Mohon tunggu sebentar',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                            form.submit();
                        }
                    });
                }
            });
        });

        // Function to show payment instructions
        function showPaymentInstruction(method) {
            const container = document.getElementById('payment-instruction');
            container.classList.remove('hidden');
            container.classList.add('animate-fadeIn');

            if (method === 'manual_transfer') {
                container.innerHTML = `
                    <div class="text-white">
                        <h3 class="text-lg font-semibold mb-3 flex items-center text-yellow-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" />
                                <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd" />
                            </svg>
                            Instruksi Transfer Bank
                        </h3>
                        <div class="space-y-3">
                            <p>Silakan transfer ke salah satu rekening berikut:</p>
                            <div class="bg-gray-800 p-3 rounded-lg">
                                <p class="font-bold">Bank BRI</p>
                                <p>208201010102569</p>
                                <p>a/n Seado Safari Samosir</p>
                            </div>
                            <div class="bg-gray-800 p-3 rounded-lg">
                                <p class="font-bold">Bank SUMUT</p>
                                <p>241.01.04.002036-3</p>
                                <p>a/n Seado Safari Samosir</p>
                            </div>
                            <p class="text-yellow-400 text-sm mt-2">Setelah transfer, Anda akan diminta untuk mengupload bukti pembayaran.</p>
                        </div>
                    </div>
                `;
            } else if (method === 'qris') {
                container.innerHTML = `
                    <div class="text-white">
                        <h3 class="text-lg font-semibold mb-3 flex items-center text-yellow-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h3a1 1 0 011 1v3a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm2 2V5h1v1H5zM3 13a1 1 0 011-1h3a1 1 0 011 1v3a1 1 0 01-1 1H4a1 1 0 01-1-1v-3zm2 2v-1h1v1H5zM13 3a1 1 0 00-1 1v3a1 1 0 001 1h3a1 1 0 001-1V4a1 1 0 00-1-1h-3zm1 2v1h1V5h-1z" clip-rule="evenodd" />
                                <path d="M11 4a1 1 0 10-2 0v1a1 1 0 002 0V4zM10 7a1 1 0 011 1v1h2a1 1 0 110 2h-3a1 1 0 01-1-1V8a1 1 0 011-1zM16 9a1 1 0 100 2 1 1 0 000-2zM9 13a1 1 0 011-1h1a1 1 0 110 2v2a1 1 0 11-2 0v-3zM7 11a1 1 0 100-2H4a1 1 0 100 2h3zM17 13a1 1 0 01-1 1h-2a1 1 0 110-2h2a1 1 0 011 1zM16 17a1 1 0 100-2h-3a1 1 0 100 2h3z" />
                            </svg>
                            Instruksi Pembayaran QRIS
                        </h3>
                        <div class="flex flex-col items-center space-y-3">
                            <p>Scan QR code berikut menggunakan aplikasi e-wallet atau mobile banking Anda:</p>
                            <img src="{{ asset('images/qris-code.png') }}" alt="QR Code" class="w-48 h-48 object-contain bg-white p-4 rounded-lg">
                            <p class="text-yellow-400 text-sm">Setelah pembayaran berhasil, Anda akan menerima konfirmasi otomatis.</p>
                        </div>
                    </div>
                `;
            }
        }
    </script>


    <style>
        .swal2-popup {
            background: #1f2937 !important;
            color: #fff !important;
            border-radius: 0.75rem !important;
        }

        .swal2-title,
        .swal2-html-container {
            color: #fff !important;
        }

        .swal2-confirm {
            background-color: #f59e0b !important;
        }

        .animate-fadeIn {
            animation: fadeIn 0.3s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</x-front-layout>
