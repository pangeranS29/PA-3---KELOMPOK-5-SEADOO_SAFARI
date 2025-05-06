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
                                    <span class="text-gray-300">Tanggal</span>
                                    <span class="text-white font-medium">
                                        {{ \Carbon\Carbon::parse($booking->waktu_mulai)->translatedFormat('d F Y') }}
                                    </span>
                                </div>

                                <div class="flex justify-between items-center">
                                    <span class="text-gray-300">Waktu</span>
                                    <span class="text-white font-medium">
                                        {{ \Carbon\Carbon::parse($booking->waktu_mulai)->format('H:i') }} -
                                        {{ \Carbon\Carbon::parse($booking->waktu_selesai)->format('H:i') }}
                                    </span>
                                </div>

                                <div class="flex justify-between items-center">
                                    <span class="text-gray-300">Jumlah Penumpang</span>
                                    <span class="text-white font-medium">{{ $booking->jumlah_penumpang }}</span>
                                </div>

                                <div class="flex justify-between items-center mb-4">
                                    <span class="text-gray-300">Harga Paket:</span>
                                    <span class="text-white font-medium">Rp
                                        {{ number_format($booking->detail_paket->pilihpaket->harga, 0, ',', '.') }}</span>
                                </div>

                                @if ($booking->harga_drone > 0)
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-300">Tambahan Drone</span>
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

                <!-- Kolom Kanan - Form Upload Bukti Pembayaran -->
                <div class="lg:w-2/3">
                    <div class="bg-gray-800 rounded-xl shadow-2xl overflow-hidden">
                        <div class="bg-gradient-to-r from-yellow-500 to-yellow-400 p-4">
                            <h1 class="text-black text-2xl font-bold">UPLOAD BUKTI PEMBAYARAN</h1>
                        </div>

                        <div class="p-6">
                            @if (session('success'))
                                <div class="bg-green-500 text-white p-4 rounded mb-6 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="bg-red-500 text-white p-4 rounded mb-6 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    {{ session('error') }}
                                </div>
                            @endif

                            <div class="mb-6 bg-gray-700/50 rounded-lg p-4 border border-gray-600">
                                <div class="flex items-center text-yellow-400 mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <h3 class="font-semibold">Instruksi Upload</h3>
                                </div>
                                <ul class="text-gray-300 text-sm space-y-2 pl-5 list-disc">
                                    <li>Pastikan bukti transfer jelas terbaca</li>
                                    <li>Format file: JPG, PNG, atau PDF (maks. 2MB)</li>
                                    <li>Nominal transfer harus sesuai dengan total pembayaran</li>
                                    <li>Verifikasi membutuhkan waktu 1x24 jam</li>
                                </ul>
                            </div>

                            <form id="paymentForm" action="{{ route('front.payment.upload', $booking->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                                @csrf
                                <!-- File Upload -->
                                <div class="space-y-2">
                                    <label for="bukti_pembayaran" class="block text-white font-medium">Upload Bukti Pembayaran</label>
                                    <div class="flex items-center justify-center w-full">
                                        <label for="bukti_pembayaran"
                                            class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-gray-600 rounded-lg cursor-pointer bg-gray-700/50 hover:bg-gray-700 transition">
                                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="h-10 w-10 text-gray-400 mb-2" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                                </svg>
                                                <p class="text-sm text-gray-400">
                                                    <span class="font-semibold">Klik untuk upload</span> atau drag & drop
                                                </p>
                                                <p class="text-xs text-gray-500">JPG, PNG, atau PDF (maks. 2MB)</p>
                                            </div>
                                            <input id="bukti_pembayaran" name="bukti_pembayaran" type="file"
                                                class="hidden" required />
                                        </label>
                                    </div>
                                    @error('bukti_pembayaran')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Submit Button -->
                                <button type="button" id="submitButton"
                                    class="w-full bg-gradient-to-r from-yellow-500 to-yellow-400 hover:from-yellow-400 hover:to-yellow-300 text-black font-bold py-3 px-4 rounded-lg shadow-lg transition-all transform hover:scale-[1.01]">
                                    Upload Bukti Pembayaran
                                </button>

                                <!-- Back Button -->
                                <a href="{{ route('front.index') }}"
                                    class="block text-center text-gray-300 hover:text-white mt-4 transition">
                                    Kembali ke Beranda
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Preview uploaded file name
        document.getElementById('bukti_pembayaran').addEventListener('change', function(e) {
            const fileName = e.target.files[0]?.name || 'Belum ada file dipilih';
            const uploadArea = e.target.parentElement;

            const existingFileName = uploadArea.querySelector('.file-name');
            if (existingFileName) {
                existingFileName.remove();
            }

            const fileNameElement = document.createElement('p');
            fileNameElement.className = 'file-name text-sm text-yellow-400 mt-2';
            fileNameElement.textContent = fileName;
            uploadArea.appendChild(fileNameElement);
        });

        // Handle form submission with SweetAlert
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('paymentForm');
            const submitButton = document.getElementById('submitButton');
            const fileInput = document.getElementById('bukti_pembayaran');

            // Show success/error messages from server
            @if (session('success'))
                Swal.fire({
                    title: 'Berhasil!',
                    html: `{!! session('success') !!}`,
                    icon: 'success',
                    confirmButtonColor: '#f59e0b'
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    title: 'Gagal!',
                    text: `{!! session('error') !!}`,
                    icon: 'error',
                    confirmButtonColor: '#f59e0b'
                });
            @endif

            // Form submission handler
            submitButton.addEventListener('click', function(e) {
                e.preventDefault();

                // Check if file is selected
                if (!fileInput.files || fileInput.files.length === 0) {
                    Swal.fire({
                        title: 'Peringatan',
                        text: 'Silakan pilih file bukti pembayaran terlebih dahulu',
                        icon: 'warning',
                        confirmButtonColor: '#f59e0b'
                    });
                    return;
                }

                // Check file size (max 2MB)
                const file = fileInput.files[0];
                const maxSize = 2 * 1024 * 1024; // 2MB
                if (file.size > maxSize) {
                    Swal.fire({
                        title: 'File Terlalu Besar',
                        text: 'Ukuran file maksimal 2MB. Silakan pilih file yang lebih kecil.',
                        icon: 'error',
                        confirmButtonColor: '#f59e0b'
                    });
                    return;
                }

                // Check file type
                const validTypes = ['image/jpeg', 'image/png', 'application/pdf'];
                if (!validTypes.includes(file.type)) {
                    Swal.fire({
                        title: 'Format File Tidak Didukung',
                        text: 'Hanya file JPG, PNG, atau PDF yang diperbolehkan.',
                        icon: 'error',
                        confirmButtonColor: '#f59e0b'
                    });
                    return;
                }

                // Show confirmation dialog
                Swal.fire({
                    title: 'Konfirmasi Upload',
                    html: `
                        <div class="text-left">
                            <p>Anda yakin ingin mengupload bukti pembayaran ini?</p>
                            <div class="mt-3 p-3 bg-gray-800 rounded-lg">
                                <p class="text-sm font-medium text-gray-300">Detail File:</p>
                                <p class="text-sm text-yellow-400">${file.name}</p>
                                <p class="text-xs text-gray-400">${(file.size / 1024 / 1024).toFixed(2)} MB</p>
                            </div>
                            <p class="text-sm text-yellow-400 mt-2">Pastikan file jelas dan sesuai nominal.</p>
                        </div>
                    `,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#f59e0b',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, Upload Sekarang',
                    cancelButtonText: 'Periksa Kembali'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Show loading state
                        Swal.fire({
                            title: 'Sedang Mengupload...',
                            html: 'Mohon tunggu sebentar, file Anda sedang diproses',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });

                        // Submit the form
                        form.submit();
                    }
                });
            });
        });
    </script>
</x-front-layout>
