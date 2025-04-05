<x-front-layout>
    <main class="flex justify-center items-center min-h-screen pt-20" style="background-color: #000000;">
        <div class="bg-gray-800 p-8 rounded-lg w-full max-w-md text-center">
            <h1 class="text-white text-2xl font-semibold mb-4">Booking Berhasil!</h1>
            <p class="text-gray-300 mb-6">Kami telah mengirimkan email konfirmasi beserta instruksi selanjutnya ke email Anda.</p>

            <div class="flex justify-center">
                <a href="{{ route('front.index') }}"
                   class="bg-yellow-500 text-black px-6 py-2 rounded hover:bg-yellow-400 transition-all duration-200">
                    Kembali ke Beranda
                </a>
            </div>

            <div class="mt-8">
                <img src="/images/porsche_small.webp" alt="Porsche" class="w-full rounded-lg shadow-lg">
            </div>
        </div>
    </main>
</x-front-layout>
