<x-front-layout>
    <!-- Hero -->
    <section class="container relative pt-[30px]" style="background-color: #000000;">
        <div class="flex flex-col items-center justify-center gap-[30px]">
            <!-- Preview Image -->
            <div class="relative">

                <img src="/images/images.png" style="width: 1440px; height: 450px;" class="z-10 relative" alt="">
            </div>


        </div>
    </section>

    <!-- Popular Cars -->
    <section class=bg-[#000000]>
        <div class="container relative py-[100px]">
            <header class="mb-[10px]">
                <div class="text-center mb-8">
                    <h1 class="text-lg font-semibold text-white">DESTINATION</h1>
                    <h2 class="text-4xl font-bold text-yellow-500">POPULAR PLACE</h2>
                </div>
            </header>

            <!-- Cars -->
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-[29px]">

                @foreach ($detail_pakets as $detail_paket)
                    <!-- Card -->
                    <div class="card-popular">
                        <div>
                            <div class="">
                                <h5 class="text-lg text-dark font-bold mb-[2px]">
                                    {{ $detail_paket->pilihpaket ? $detail_paket->pilihpaket->nama_paket : '-' }}

                                </h5>
                                <div class="flex items-center justify-between gap-1">
                                    <p class="text-sm font-normal text-secondary">
                                        {{ $detail_paket->pilihpaket ? $detail_paket->pilihpaket->durasi : '-' }}/Minutes
                                    </p>



                                    <p class="text-dark text-xs font-semibold flex items-center gap-[2px]">
                                        ({{ $detail_paket->rating }}/5)
                                        <img src="/svgs/ic-star.svg" alt="">
                                    </p>


                                    <a href="{{ route('front.detail', $detail_paket->id) }}"
                                        class="absolute inset-0"></a>

                                </div>


                            </div>
                        </div>
                        <img src="{{ $detail_paket->thumbnail }}" class="rounded-[18px] min-w-[216px] w-full h-[150px]"
                            alt="">
                        <div class="flex items-center justify-between gap-1">
                            <!-- Price -->
                            <p class="text-sm font-normal text-secondary">
                                <span class="text-yellow-500 text-base font-bold ">Rp.
                                    {{ $detail_paket->pilihpaket ? $detail_paket->pilihpaket->harga : '-' }}
                            </p>

                            <button
                                class="bg-black text-white text-sm font-semibold px-4 py-2 rounded-lg hover:bg-black">
                                Book Now
                            </button>



                        </div>
                    </div>
                @endforeach


            </div>

            <!-- Carousel Navigation -->
            <div class="flex justify-center mt-8 space-x-4">
                <button id="carouselPrev"
                    class="p-2 rounded-full bg-yellow-500 text-black hover:bg-yellow-600 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button id="carouselNext"
                    class="p-2 rounded-full bg-yellow-500 text-black hover:bg-yellow-600 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>
        </div>
    </section>

    <!-- Rest of your sections remain the same -->
    <!-- Extra Benefits, FAQ, Instant Booking, etc. -->

    <!-- Add this script at the bottom of your layout -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const carousel = document.getElementById('destinationCarousel');
            const cards = document.querySelectorAll('.card-popular');
            const prevBtn = document.getElementById('carouselPrev');
            const nextBtn = document.getElementById('carouselNext');

            let currentIndex = 0;
            const cardWidth = cards[0].offsetWidth;
            const visibleCards = window.innerWidth >= 1024 ? 4 : window.innerWidth >= 768 ? 2 : 1;

            function updateCarousel() {
                const offset = -currentIndex * cardWidth;
                carousel.style.transform = `translateX(${offset}px)`;
            }

            prevBtn.addEventListener('click', function() {
                if (currentIndex > 0) {
                    currentIndex--;
                    updateCarousel();
                }
            });

            nextBtn.addEventListener('click', function() {
                if (currentIndex < cards.length - visibleCards) {
                    currentIndex++;
                    updateCarousel();
                }
            });

            // Handle window resize
            window.addEventListener('resize', function() {
                const newVisibleCards = window.innerWidth >= 1024 ? 4 : window.innerWidth >= 768 ? 2 : 1;
                if (newVisibleCards !== visibleCards) {
                    currentIndex = 0;
                    updateCarousel();
                }
            });
        });
    </script>

</x-front-layout>
