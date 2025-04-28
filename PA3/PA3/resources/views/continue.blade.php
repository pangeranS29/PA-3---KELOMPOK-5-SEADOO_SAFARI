<x-front-layout>
    <main class="flex justify-center items-center min-h-screen pt-20 bg-[#1a1a1a]">
        <div class="bg-gray-800 p-8 rounded-lg w-full max-w-md text-center shadow-lg border border-gray-700">
            <h1 class="text-2xl font-semibold text-white mb-4">Booking Berhasil!</h1>
            <p class="text-gray-300 mb-6">Silakan upload bukti pembayaran untuk proses verifikasi.</p>

            {{-- Upload Form --}}
            <form action="{{ route('front.payment.upload', $booking->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-6">
                    <label for="bukti_pembayaran" class="block text-white font-semibold mb-2">Upload Bukti Pembayaran</label>
                    <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" required
                        class="w-full p-3 bg-gray-700 text-white rounded-md border border-gray-600 focus:outline-none focus:ring-2 focus:ring-yellow-400">

                    @error('bukti_pembayaran')
                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="bg-yellow-500 hover:bg-yellow-400 text-black font-semibold py-2 rounded w-full mb-4">
                    Upload dan Lanjutkan
                </button>
            </form>

            {{-- Back Button --}}
            <div class="flex justify-center">
                <a href="{{ route('front.index') }}" class="bg-blue-500 hover:bg-blue-400 text-black font-semibold py-2 px-6 rounded">
                    Kembali ke Beranda
                </a>
            </div>

            {{-- Flash Message --}}
            @if (session('message'))
                <div class="mt-4 bg-green-500 text-white p-4 rounded">
                    {{ session('message') }}
                </div>
            @endif
        </div>
    </main>
</x-front-layout>
