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
                                    <span class="text-gray-300 font-medium text-sm whitespace-nowrap">
                                        Pembayaran:a
                                    </span>
                                    @if ($booking->status_pembayaran === 'pending')
                                        <span class="text-yellow-400 text-sm font-bold whitespace-nowrap">
                                            Menunggu Konfirmasi
                                        </span>
                                    @else
                                        <span class="text-yellow-400 text-sm font-bold whitespace-nowrap">
                                            Rp {{ number_format($booking->total_harga, 0, ',', '.') }}
                                        </span>
                                    @endif
                                </div>
                            </div>


                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan - Success Message -->
                <div class="lg:w-2/3">
                    <div class="bg-gray-800 rounded-xl shadow-2xl overflow-hidden">
                        <div class="bg-gradient-to-r from-green-500 to-green-400 p-4">
                            <h1 class="text-black text-2xl font-bold">PEMBAYARAN BERHASIL DIUPLOAD!</h1>
                        </div>

                        <div class="p-6">
                            <div class="text-center mb-8">
                                <div
                                    class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100 mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-600"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <h2 class="text-2xl font-bold text-white mb-2">Upload Bukti Pembayaran Berhasil!</h2>
                                <p class="text-gray-300">Silakan konfirmasi pembayaran Anda kepada Admin kami melalui
                                    WhatsApp.</p>
                            </div>

                            <div class="space-y-6">
                                <!-- WhatsApp Button -->
                                <a href="https://wa.me/6285763189029?text=Halo%20Admin,%20saya%20{{ urlencode($booking->nama_customer) }}%20telah%20melakukan%20pembayaran%20untuk%20booking%20dengan%20detail:%0A%0AID%20Booking:%20{{ $booking->id }}%0APaket:%20{{ $booking->detail_paket->pilihpaket->nama_paket ?? 'N/A' }}%0ATotal%20Harga:%20Rp%20{{ number_format($booking->total_harga, 0, ',', '.') }}%0A%0ATerima%20kasih."
                                    target="_blank"
                                    class="block w-full bg-gradient-to-r from-green-500 to-green-400 hover:from-green-400 hover:to-green-300 text-black font-bold py-3 px-4 rounded-lg shadow-lg transition-all transform hover:scale-[1.01] flex items-center justify-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.479 5.092 1.479 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                                    </svg>
                                    Hubungi Admin via WhatsApp
                                </a>

                                <!-- Check Order Status Button -->
                                <a href="{{ url('/account?tab=transaction') }}"
                                    class="block text-center bg-yellow-500 text-white hover:bg-yellow-400 mt-4 px-4 py-2 rounded transition">
                                    Cek Status Pemesanan
                                </a>
                                <!-- Back to Home Button -->
                                <a href="{{ route('front.index') }}"
                                    class="block text-center bg-[#3085d6] text-white hover:bg-[#3085d6] mt-2 px-4 py-2 rounded transition">
                                    Kembali ke Beranda
                                </a>


                                <!-- Admin Info -->
                                <div class="mt-8 p-4 bg-gray-700/50 rounded-lg border border-gray-600">
                                    <h3 class="text-yellow-400 font-semibold mb-2 flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Informasi Kontak Admin
                                    </h3>
                                    <div class="text-gray-300 text-sm space-y-1">
                                        <p class="flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                            </svg>
                                            WhatsApp: +62 857-6318-9029
                                        </p>
                                        <p class="flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Jam Operasional: 08:00 - 17:00 WIB
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-front-layout>
