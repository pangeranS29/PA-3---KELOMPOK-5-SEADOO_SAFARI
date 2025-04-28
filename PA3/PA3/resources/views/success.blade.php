<x-front-layout>
    <main class="flex justify-center items-center min-h-screen pt-20" style="background-color: #000000;">
        <div class="bg-gray-800 p-8 rounded-lg w-full max-w-md text-center">
            <h1 class="text-white text-2xl font-semibold mb-4">Upload Bukti Pembayaran Berhasil!</h1>
            <p class="text-gray-300 mb-6">Silakan konfirmasi pembayaran Anda kepada Admin kami melalui WhatsApp.</p>

            <div class="flex justify-center mb-4">
                <a href="https://wa.me/6285763189029?text=Halo%20Admin,%20saya%20{{ urlencode($booking->nama_customer) }}%20telah%20melakukan%20pembayaran%20untuk%20booking%20dengan%20detail:%0A%0AID%20Booking:%20{{ $booking->id }}%0APaket:%20{{ $booking->detail_paket->pilihpaket->nama_paket ?? 'N/A' }}%0ATotal%20Harga:%20Rp%20{{ number_format($booking->total_harga, 0, ',', '.') }}%0A%0ATerima%20kasih."
                   target="_blank"
                   class="bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600 transition-all duration-200 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.479 5.092 1.479 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                    </svg>
                    Hubungi Admin via WhatsApp
                </a>
            </div>

            <div class="flex justify-center">
                <a href="{{ route('front.index') }}"
                    class="bg-gray-600 text-white px-6 py-2 rounded hover:bg-gray-500 transition-all duration-200">
                    Kembali ke Beranda
                </a>
            </div>

            <div class="mt-6 text-gray-400 text-sm">
                <p>Nomor WhatsApp Admin: +62 857-6318-9029</p>
                <p class="mt-2">Jam Operasional: 08:00 - 17:00 WIB</p>
            </div>
        </div>
    </main>
</x-front-layout>
