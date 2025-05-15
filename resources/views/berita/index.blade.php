<x-front-layout>
    <!-- Hero Section -->


    <!-- News Section -->
    <section class="bg-black py-12">
        <div class="container">
            <header class="mb-8 text-center">
                <h1 class="text-lg font-semibold text-white">INFORMASI TERBARU</h1>
                <h2 class="text-4xl font-bold text-yellow-500">BERITA & ARTIKEL</h2>
            </header>

            <!-- News Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($beritas as $berita)
                <div class="col-span-1">
                    <!-- Card -->
                    <div class="bg-dark text-white rounded-xl overflow-hidden shadow-lg h-full flex flex-col transition-transform duration-300 hover:scale-105">
                        <!-- Gambar -->
                        @if($berita->gambar)
                        <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" class="w-full h-48 object-cover">
                        @else
                        <div class="w-full h-48 bg-gray-800 flex items-center justify-center">
                            <span class="text-gray-400">No Image</span>
                        </div>
                        @endif

                        <!-- Konten -->
                        <div class="p-6 flex flex-col flex-grow">
                            <!-- Tanggal -->
                            <span class="text-yellow-500 text-sm mb-2">
                                {{ $berita->tanggal_publikasi->format('d M Y') }}
                            </span>

                            <!-- Judul -->
                            <h3 class="text-xl font-bold text-white mb-3 line-clamp-2">
                                {{ $berita->judul }}
                            </h3>

                            <!-- Ringkasan -->
                            <p class="text-gray-400 mb-4 line-clamp-3">
                                {{ $berita->ringkasan }}
                            </p>

                            <!-- Tombol Baca Selengkapnya -->
                            <a href="{{ route('front.berita.show', $berita->slug) }}"
                               class="mt-auto text-yellow-500 hover:text-yellow-400 font-semibold inline-flex items-center">
                                Baca Selengkapnya
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($beritas->hasPages())
            <div class="mt-10 flex justify-center">
                {{ $beritas->links('vendor.pagination.custom') }}
            </div>
            @endif
        </div>
    </section>
</x-front-layout>
