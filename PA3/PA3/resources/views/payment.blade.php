<x-front-layout>
    <main class="flex justify-center items-center min-h-screen pt-20 bg-black">
        <div class="bg-gray-800 p-8 rounded-lg w-full max-w-md">
            <h1 class="text-2xl font-semibold text-white text-center mb-6">Pembayaran</h1>

            {{-- Flash Message --}}
            @if (session('success'))
                <div class="bg-green-500 text-white p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Booking Details --}}
            <div class="text-white mb-6 space-y-2">
                <p><strong>Nama:</strong> {{ $booking->nama_customer }}</p>
                <p><strong>No. Telepon:</strong> {{ $booking->no_telepon }}</p>
                <p><strong>Paket:</strong> {{ $booking->detail_paket->pilihpaket->nama_paket }}</p>
                <p><strong>Waktu Mulai:</strong> {{ $booking->waktu_mulai }}</p>
                <p><strong>Waktu Selesai:</strong> {{ $booking->waktu_selesai }}</p>



                @if ($booking->harga_drone)
                    <p class="text-yellow-400"><strong>Include Drone:</strong> Rp {{ number_format($booking->harga_drone, 0, ',', '.') }}</p>
                @endif

                <p><strong>Jumlah Penumpang:</strong> {{ $booking->jumlah_penumpang }}</p>

                @if ($booking->nama_penumpang1)
                    <p><strong>Nama Penumpang 1:</strong> {{ $booking->nama_penumpang1 }}</p>
                @endif
                @if ($booking->nama_penumpang2)
                    <p><strong>Nama Penumpang 2:</strong> {{ $booking->nama_penumpang2 }}</p>
                @endif

                <p><strong>Total Harga:</strong> Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</p>
            </div>

            {{-- Payment Status --}}
            @switch($booking->status_pembayaran)
                @case('expire')
                    <div class="bg-red-600 text-white p-4 rounded mb-4">
                        Pembayaran Anda <strong>kadaluarsa</strong>. Silakan lakukan pemesanan ulang.
                    </div>
                    <a href="{{ route('front.index') }}" class="block text-center bg-blue-500 hover:bg-blue-400 text-white font-semibold py-2 rounded">
                        Booking Ulang
                    </a>
                    @break

                @case('settlement')
                    <div class="bg-green-500 text-white p-4 rounded mb-4">
                        Pembayaran Anda <strong>berhasil</strong>.
                    </div>
                    @break

                @default
                    @if ($booking->metode_pembayaran === 'midtrans' && $booking->url_pembayaran)
                        <div class="bg-yellow-400 text-black p-4 rounded mb-4">
                            Pembayaran Anda belum selesai. Silakan lanjutkan melalui tombol di bawah ini.
                        </div>

                        <div class="flex flex-col gap-3">
                            <a href="{{ $booking->url_pembayaran }}" target="_blank"
                                class="block bg-yellow-500 hover:bg-yellow-400 text-black font-semibold py-2 rounded text-center">
                                Lanjutkan Pembayaran
                            </a>
                            <a href="{{ route('front.payment.cancel', $booking->id) }}"
                                onclick="return confirm('Apakah Anda yakin ingin membatalkan pembayaran ini?');"
                                class="block bg-red-600 hover:bg-red-500 text-white font-semibold py-2 rounded text-center">
                                Batalkan Pembayaran
                            </a>
                        </div>
                    @else
                        {{-- Pilih Metode Pembayaran --}}
                        <form action="{{ route('front.payment.update', $booking->id) }}" method="POST" id="payment-form">
                            @csrf

                            <div class="mb-6">
                                <h5 class="text-lg font-semibold text-white mb-4">Pilih Metode Pembayaran:</h5>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                                    {{-- Manual Transfer --}}
                                    <div class="relative">
                                        <input type="radio" id="manual_transfer" name="metode_pembayaran" value="manual_transfer" class="peer absolute inset-0 opacity-0 cursor-pointer" required onclick="showPaymentInstruction('manual_transfer')">
                                        <label for="manual_transfer" class="flex items-center justify-center gap-4 bg-gray-700 border border-gray-500 rounded-2xl p-5 min-h-[80px] hover:border-yellow-400 peer-checked:border-yellow-400 peer-checked:ring-2 peer-checked:ring-yellow-400 transition-all">
                                            <img src="{{ asset('svgs/bank.svg') }}" alt="Manual Transfer" width="40">
                                            <p class="text-white font-semibold">Transfer Bank</p>
                                        </label>
                                    </div>

                                    {{-- QRIS --}}
                                    <div class="relative">
                                        <input type="radio" id="qris" name="metode_pembayaran" value="qris" class="peer absolute inset-0 opacity-0 cursor-pointer" required onclick="showPaymentInstruction('qris')">
                                        <label for="qris" class="flex items-center justify-center gap-4 bg-gray-700 border border-gray-500 rounded-2xl p-5 min-h-[80px] hover:border-yellow-400 peer-checked:border-yellow-400 peer-checked:ring-2 peer-checked:ring-yellow-400 transition-all">
                                            <img src="{{ asset('svgs/qris.svg') }}" alt="QRIS" width="40">
                                            <p class="text-white font-semibold">QRIS</p>
                                        </label>
                                    </div>

                                </div>
                            </div>

                            {{-- Payment Instruction --}}
                            <div id="payment-instruction" class="hidden mb-6">
                                {{-- JavaScript will fill this --}}
                            </div>

                            <button type="submit" class="bg-yellow-500 hover:bg-yellow-400 text-black font-semibold py-2 rounded w-full">
                                Pilih dan Lanjutkan
                            </button>
                        </form>
                    @endif
            @endswitch
        </div>
    </main>

    {{-- Script Show Instruction --}}
    <script>
        function showPaymentInstruction(method) {
            const container = document.getElementById('payment-instruction');
            container.classList.remove('hidden');

            if (method === 'manual_transfer') {
                container.innerHTML = `
                    <div class="bg-blue-600 text-white p-4 rounded">
                        <h5 class="text-lg font-semibold mb-2">Instruksi Transfer Bank:</h5>
                        <p>Transfer ke rekening berikut:</p>
                        <p class="mt-2 font-bold">Bank BCA 1234567890 a/n PT Jasa Anda</p>
                        <p class="mt-2">Setelah transfer, upload bukti pembayaran di halaman selanjutnya.</p>
                    </div>
                `;
            } else if (method === 'qris') {
                container.innerHTML = `
                    <div class="bg-blue-600 text-white p-4 rounded">
                        <h5 class="text-lg font-semibold mb-2">Instruksi Pembayaran QRIS:</h5>
                        <p>Scan QR code di bawah ini:</p>
                        <img src="{{ asset('images/qris-code.png') }}" alt="QRIS" class="w-48 mx-auto mt-4 rounded">
                        <p class="mt-2 text-center">Setelah pembayaran, upload bukti pembayaran di halaman selanjutnya.</p>
                    </div>
                `;
            }
        }
    </script>
</x-front-layout>


tolong ubah format waktu mulai dan selesai menggunakan translatedFormat('d F Y, H:i') }}
