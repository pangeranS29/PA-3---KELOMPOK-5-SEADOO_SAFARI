    <x-front-layout>
        <!-- Hero -->
        <section class="container-fluid p-0" style="background-color: #000000;">
            <div class="flex flex-col items-center justify-center">
                <!-- Preview Image -->
                <div class="w-100">
                    <img src="/images/images.png" class="img-fluid w-100" style="height: 450px; object-fit: cover;"
                        alt="">
                </div>
            </div>
        </section>

        <!-- Popular Cars -->
        <section class="bg-black py-5">
            <div class="container">
                <header class="mb-5 text-center">
                    <h1 class="text-lg font-semibold text-white">DESTINATION</h1>
                    <h2 class="text-4xl font-bold text-warning">POPULAR PLACE</h2>
                </header>

                <!-- Carousel -->
                <div id="destinationCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @php
                            $chunks = $detail_pakets->chunk(4); // 4 cards per slide for desktop
                        @endphp

                        @foreach ($chunks as $index => $chunk)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                                    @foreach ($chunk as $detail_paket)
                                        <div class="col-span-1">
                                            <!-- Card -->
                                            <div
                                                class="bg-dark text-white rounded-3xl overflow-hidden shadow-lg h-full flex flex-col">
                                                <!-- Gambar -->
                                                <img src="{{ $detail_paket->thumbnail }}"
                                                    alt="{{ $detail_paket->pilihpaket ? $detail_paket->pilihpaket->nama_paket : 'Jetski' }}"
                                                    class="w-full h-[150px] object-cover">

                                                <!-- Konten -->
                                                <div class="p-4 flex flex-col flex-grow">
                                                    <!-- Nama Paket -->
                                                    <h5 class="text-white text-lg font-bold mb-1">
                                                        {{ $detail_paket->pilihpaket ? $detail_paket->pilihpaket->nama_paket : '-' }}
                                                    </h5>

                                                    <!-- Durasi -->
                                                    <div class="flex justify-between items-center mb-2">
                                                        <span class="text-sm text-gray-400">
                                                            {{ $detail_paket->pilihpaket ? $detail_paket->pilihpaket->durasi : '-' }}
                                                            Minutes
                                                        </span>
                                                    </div>

                                                    <!-- Harga & Tombol -->
                                                    <div class="flex justify-between items-center mt-auto pt-2">
                                                        <!-- Harga -->
                                                        <span class="text-yellow-500 font-bold text-base">
                                                            Rp.
                                                            {{ $detail_paket->pilihpaket ? number_format($detail_paket->pilihpaket->harga, 0, ',', '.') : '-' }}
                                                        </span>

                                                        <!-- Tombol Book Now -->
                                                        <a href="{{ route('front.detail', $detail_paket->id) }}"
                                                            class="bg-yellow-500 hover:bg-yellow-600 text-black text-sm font-semibold px-3 py-1 rounded-md transition">
                                                            Book Now
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Custom Carousel Controls (Bootstrap tetap digunakan untuk fungsionalitas) -->
                    <button class="carousel-control-prev position-absolute start-1 top-50 translate-middle-y"
                        type="button" data-bs-target="#destinationCarousel" data-bs-slide="prev" style="left: -50px;">
                        <span class="carousel-control-prev-icon bg-warning rounded-circle p-3"
                            aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next position-absolute end-1 top-50 translate-middle-y"
                        type="button" data-bs-target="#destinationCarousel" data-bs-slide="next" style="right: -50px;">
                        <span class="carousel-control-next-icon bg-warning rounded-circle p-3"
                            aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
        </section>

        <!-- Bootstrap JS Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Font Awesome for icons -->
        <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    </x-front-layout>
