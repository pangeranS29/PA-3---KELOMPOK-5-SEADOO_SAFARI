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

                            @switch($booking->status_pembayaran)
                                @case('expire')
                                    <!-- ... (bagian expire tetap sama) ... -->
                                @break

                                @case('settlement')
                                    <!-- ... (bagian settlement tetap sama) ... -->
                                @break

                                @default
                                    @if ($booking->metode_pembayaran === 'midtrans' && $booking->url_pembayaran)
                                        <!-- ... (bagian midtrans tetap sama) ... -->
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

    <!-- Payment Instruction Modal -->
    <div id="payment-instruction-modal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-900 opacity-75"></div>
            </div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div class="inline-block align-bottom bg-gray-800 rounded-xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                            <h3 id="payment-modal-title" class="text-lg leading-6 font-semibold text-yellow-400 mb-4 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" />
                                    <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd" />
                                </svg>
                                Instruksi Transfer Bank
                            </h3>

                            <div id="payment-modal-content" class="mt-2 text-white">
                                <!-- Content will be filled by JavaScript -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-700 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" onclick="closePaymentInstruction()"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-yellow-500 text-base font-medium text-black hover:bg-yellow-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

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

        // Function to show payment instructions in modal
        function showPaymentInstruction(method) {
            const modal = document.getElementById('payment-instruction-modal');
            const title = document.getElementById('payment-modal-title');
            const content = document.getElementById('payment-modal-content');

            if (method === 'manual_transfer') {
                title.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" />
                        <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd" />
                    </svg>
                    Instruksi Transfer Bank
                `;

                content.innerHTML = `
                    <div class="space-y-4 max-h-96 overflow-y-auto pr-2">
                        <p>Silakan transfer ke salah satu rekening berikut:</p>

                        <div class="bg-gray-700 p-4 rounded-lg">
                            <div class="flex items-center mb-2">

                                <div>
                                    <p class="font-bold text-yellow-400">Bank BRI</p>

                                </div>
                            </div>
                            <div class="bg-gray-800 p-3 rounded">
                                <p class="text-sm text-gray-400">Nomor Rekening</p>
                                <p class="font-mono text-lg">208201010102569</p>
                                <p class="text-sm mt-1">a/n Seado Safari Samosir</p>
                            </div>
                        </div>

                        <div class="bg-gray-700 p-4 rounded-lg">
                            <div class="flex items-center mb-2">

                                <div>
                                    <p class="font-bold text-yellow-400">Bank SUMUT</p>

                                </div>
                            </div>
                            <div class="bg-gray-800 p-3 rounded">
                                <p class="text-sm text-gray-400">Nomor Rekening</p>
                                <p class="font-mono text-lg">241.01.04.002036-3</p>
                                <p class="text-sm mt-1">a/n Seado Safari Samosir</p>
                            </div>
                        </div>

                        <div class="bg-gray-700/50 p-4 rounded-lg border border-yellow-400/30">
                            <h4 class="font-semibold text-yellow-400 mb-2">Petunjuk Pembayaran:</h4>
                            <ol class="list-decimal list-inside space-y-1 text-sm">
                                <li>Transfer sesuai nominal: <strong>Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</strong></li>
                                <li>Setelah transfer, Anda akan diminta untuk mengupload bukti pembayaran</li>
                                <li>Pesanan akan diverifikasi dalam 1x24 jam</li>
                            </ol>
                        </div>
                    </div>
                `;
            } else if (method === 'qris') {
                title.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h3a1 1 0 011 1v3a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm2 2V5h1v1H5zM3 13a1 1 0 011-1h3a1 1 0 011 1v3a1 1 0 01-1 1H4a1 1 0 01-1-1v-3zm2 2v-1h1v1H5zM13 3a1 1 0 00-1 1v3a1 1 0 001 1h3a1 1 0 001-1V4a1 1 0 00-1-1h-3zm1 2v1h1V5h-1z" clip-rule="evenodd" />
                        <path d="M11 4a1 1 0 10-2 0v1a1 1 0 002 0V4zM10 7a1 1 0 011 1v1h2a1 1 0 110 2h-3a1 1 0 01-1-1V8a1 1 0 011-1zM16 9a1 1 0 100 2 1 1 0 000-2zM9 13a1 1 0 011-1h1a1 1 0 110 2v2a1 1 0 11-2 0v-3zM7 11a1 1 0 100-2H4a1 1 0 100 2h3zM17 13a1 1 0 01-1 1h-2a1 1 0 110-2h2a1 1 0 011 1zM16 17a1 1 0 100-2h-3a1 1 0 100 2h3z" />
                    </svg>
                    Instruksi Pembayaran QRIS
                `;

                content.innerHTML = `
                    <div class="flex flex-col items-center space-y-4">
                        <p>Scan QR code berikut menggunakan aplikasi e-wallet atau mobile banking Anda:</p>
                        <img src="{{ asset('images/qris-code.png') }}" alt="QR Code" class="w-48 h-48 object-contain bg-white p-4 rounded-lg">

                        <div class="bg-gray-700/50 p-4 rounded-lg border border-yellow-400/30 w-full">
                            <h4 class="font-semibold text-yellow-400 mb-2">Petunjuk Pembayaran:</h4>
                            <ol class="list-decimal list-inside space-y-1 text-sm">
                                <li>Buka aplikasi e-wallet/m-banking yang mendukung QRIS</li>
                                <li>Pilih menu 'Scan QR Code'</li>
                                <li>Arahkan kamera ke QR code di atas</li>
                                <li>Pastikan nominal pembayaran: <strong>Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</strong></li>
                                <li>Konfirmasi pembayaran</li>
                                <li>Pembayaran akan diverifikasi otomatis</li>
                            </ol>
                        </div>

                        <p class="text-yellow-400 text-sm text-center">Setelah pembayaran berhasil, Anda akan menerima konfirmasi otomatis.</p>
                    </div>
                `;
            }

            modal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        // Function to close payment instruction modal
        function closePaymentInstruction() {
            const modal = document.getElementById('payment-instruction-modal');
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        // Close modal when clicking outside
        document.getElementById('payment-instruction-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                closePaymentInstruction();
            }
        });
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

        /* Scrollbar styling for modal */
        #payment-modal-content::-webkit-scrollbar {
            width: 6px;
        }

        #payment-modal-content::-webkit-scrollbar-track {
            background: #374151;
            border-radius: 3px;
        }

        #payment-modal-content::-webkit-scrollbar-thumb {
            background: #6B7280;
            border-radius: 3px;
        }

        #payment-modal-content::-webkit-scrollbar-thumb:hover {
            background: #9CA3AF;
        }
    </style>
</x-front-layout>
