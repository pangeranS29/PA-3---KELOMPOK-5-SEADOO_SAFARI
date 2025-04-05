<x-front-layout>
    <main class="flex justify-center items-center min-h-screen pt-20" style="background-color: #000000;">
        <div class="bg-gray-800 p-8 rounded-lg w-full max-w-md">
            <h1 class="text-center text-white text-2xl mb-6">PEMBAYARAN</h1>

            {{-- Pesan sukses --}}
            @if (session('success'))
                <div class="bg-green-500 text-white p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Informasi Booking --}}
            <div class="text-white mb-6">
                <p class="mb-2"><strong>Nama:</strong> {{ $booking->nama_customer }}</p>
                <p class="mb-2"><strong>No. Telepon:</strong> {{ $booking->no_telepon }}</p>
                <p class="mb-2"><strong>Jumlah Penumpang:</strong> {{ $booking->jumlah_penumpang }}</p>
                <p class="mb-2"><strong>Waktu Mulai:</strong> {{ $booking->waktu_mulai }}</p>
                <p class="mb-2"><strong>Waktu Selesai:</strong> {{ $booking->waktu_selesai }}</p>
                <p class="mb-2"><strong>Paket:</strong> {{ $booking->detail_paket->pilihpaket->nama_paket }}</p>
                <p class="mb-2"><strong>Total Harga:</strong>
                    Rp {{ number_format($booking->total_harga, 0, ',', '.') }}
                </p>
                @if ($booking->harga_drone)
                    <p class="text-yellow-400"><strong>+ Include Drone:</strong>
                        Rp {{ number_format($booking->harga_drone, 0, ',', '.') }}
                    </p>
                @endif
            </div>

            {{-- Handle status pembayaran --}}
            @if ($booking->status_pembayaran === 'expire')
                <div class="bg-red-600 text-white p-4 rounded mb-4">
                    Pembayaran Anda telah <strong>kadaluarsa</strong>. Silakan lakukan pemesanan ulang.
                </div>
                <a href="{{ route('front.index') }}"
                   class="bg-blue-500 text-white w-full py-2 rounded hover:bg-blue-400 text-center block font-semibold">
                    Booking Ulang
                </a>

            @elseif ($booking->status_pembayaran === 'settlement')
                <div class="bg-green-500 text-white p-4 rounded mb-4">
                    Pembayaran telah <strong>berhasil</strong>.
                </div>

            @elseif ($booking->metode_pembayaran === 'midtrans' && $booking->url_pembayaran)
                <div class="bg-yellow-400 text-black p-4 rounded mb-4">
                    Pembayaran Anda belum selesai. Silakan lanjutkan melalui tombol di bawah ini.
                </div>
                <a href="{{ $booking->url_pembayaran }}"
                   class="bg-yellow-500 text-black w-full py-2 rounded hover:bg-yellow-400 text-center block font-semibold">
                    Lanjutkan Pembayaran
                </a>

            @else
                {{-- Formulir Pembayaran --}}
                <form action="{{ route('front.payment.update', $booking->id) }}" method="POST">
                    @csrf

                    <div class="flex flex-col gap-4 mb-6">
                        <h5 class="text-lg font-semibold text-white">Metode Pembayaran:</h5>
                        <div class="grid md:grid-cols-2 gap-4 md:gap-[30px] items-center">
                            {{-- MasterCard (nonaktif) --}}
                            <div class="relative opacity-30 cursor-not-allowed">
                                <input type="radio" value="mastercard" name="metode" id="mastercard"
                                    class="absolute inset-0 z-50 opacity-0 cursor-not-allowed" disabled>
                                <label for="mastercard"
                                    class="flex items-center justify-center gap-4 border border-gray-500 rounded-[20px] p-5 min-h-[80px] bg-gray-700">
                                    <img src="{{ asset('svgs/logo-mastercard.svg') }}" alt="MasterCard">
                                    <p class="text-base font-semibold text-white">MasterCard</p>
                                </label>
                            </div>

                            {{-- Midtrans (aktif) --}}
                            <div class="relative">
                                <input type="radio" value="midtrans" name="metode_pembayaran" id="midtrans"
                                    class="peer absolute inset-0 z-50 opacity-0 cursor-pointer" required>
                                <label for="midtrans"
                                    class="flex items-center justify-center gap-4 border border-gray-500 rounded-[20px] p-5 min-h-[80px] bg-gray-700
                            hover:border-yellow-400 transition-all duration-200 peer-checked:border-yellow-400 peer-checked:ring-2 peer-checked:ring-yellow-400">
                                    <img src="{{ asset('svgs/logo-midtrans.svg') }}" alt="Midtrans">
                                    <p class="text-base font-semibold text-white">Midtrans</p>
                                </label>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="bg-yellow-500 text-black w-full py-2 rounded hover:bg-yellow-400">
                        Bayar Sekarang
                    </button>
                </form>
            @endif
        </div>
    </main>
</x-front-layout>
