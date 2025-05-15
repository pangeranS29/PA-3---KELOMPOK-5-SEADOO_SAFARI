<x-front-layout>
    <!-- Hero Section -->
    <section class="container-fluid p-0 bg-black">
        <div class="container py-8">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 text-center md:text-left">
                    <h1 class="text-lg font-semibold text-white">BERITA</h1>
                    <h2 class="text-4xl font-bold text-yellow-500 mb-4">{{ $berita->judul }}</h2>
                    <div class="flex items-center justify-center md:justify-start space-x-4 text-gray-400">
                        <span>
                            <i class="far fa-calendar-alt mr-1"></i>
                            {{ $berita->tanggal_publikasi->format('d M Y') }}
                        </span>
                    </div>
                </div>
                @if($berita->gambar)
                <div class="md:w-1/2 mt-6 md:mt-0 flex justify-center md:justify-end">
                    <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" class="rounded-lg max-h-64">
                </div>
                @endif
            </div>
        </div>
    </section>

    <!-- News Content Section -->
    <section class="bg-black py-12">
        <div class="container">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Main Content -->
                <div class="lg:w-2/3">
                    <article class="prose prose-invert max-w-none">
                        <!-- Content -->
                        <div class="text-gray-300">
                            {!! nl2br(e($berita->konten)) !!}
                        </div>

                        <!-- Share Buttons -->
                        <div class="mt-12 pt-6 border-t border-gray-800">
                            <h4 class="text-white text-lg font-semibold mb-4">Bagikan Berita Ini</h4>
                            <div class="flex space-x-4">
                                <a href="#" class="bg-blue-600 text-white p-2 rounded-full hover:bg-blue-700 transition">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="bg-blue-400 text-white p-2 rounded-full hover:bg-blue-500 transition">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="bg-red-600 text-white p-2 rounded-full hover:bg-red-700 transition">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                                <a href="#" class="bg-gray-700 text-white p-2 rounded-full hover:bg-gray-800 transition">
                                    <i class="fas fa-link"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                </div>

                <!-- Sidebar -->
                <div class="lg:w-1/3">
                    <!-- Latest News -->
                    <div class="bg-gray-900 rounded-xl p-6 mb-8">
                        <h3 class="text-xl font-bold text-white mb-6 pb-2 border-b border-gray-800">Berita Terbaru</h3>
                        <div class="space-y-4">
                            @foreach($beritaTerbaru as $item)
                            <a href="{{ route('front.berita.show', $item->slug) }}" class="group flex items-start space-x-3">
                                @if($item->gambar)
                                <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}" class="w-16 h-16 object-cover rounded">
                                @else
                                <div class="w-16 h-16 bg-gray-800 rounded flex items-center justify-center">
                                    <i class="far fa-newspaper text-gray-600"></i>
                                </div>
                                @endif
                                <div>
                                    <h4 class="text-white group-hover:text-yellow-500 transition line-clamp-2">{{ $item->judul }}</h4>
                                    <span class="text-xs text-gray-400">{{ $item->tanggal_publikasi->format('d M Y') }}</span>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Back to News -->
                    <a href="{{ route('front.berita.index') }}"
                       class="inline-flex items-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-black font-semibold rounded-lg transition">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Berita
                    </a>
                </div>
            </div>
        </div>
    </section>
</x-front-layout>
