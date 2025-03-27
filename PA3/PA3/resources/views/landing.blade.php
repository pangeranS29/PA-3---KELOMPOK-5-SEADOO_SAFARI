<x-front-layout>
    <!-- Hero -->
    <section class="container relative pt-[30px]" style="background-color: #000000;">
        <div class="flex flex-col items-center justify-center gap-[30px]">
            <!-- Preview Image -->
            <div class="relative">
                {{-- <div class="absolute z-0 hidden lg:block">
                    <div class="font-extrabold text-[220px] text-darkGrey tracking-[-0.06em] leading-[101%]">
                        <div data-aos="fade-right" data-aos-delay="300">
                            JETSKI
                        </div>
                        <div data-aos=np"fade-left" data-aos-delay="600">
                            PORSCHE
                        </div>
                    </div>
                </div> --}}
                <img src="/images/images.png" style="width: 1440px; height: 450px;" class="z-10 relative" alt="">
                {{-- data-aos="zoom-in" data-aos-delay="950"> --}}
            </div>

            {{-- <div class="flex flex-col lg:flex-row items-center justify-around lg:gap-[60px] gap-7">
                <!-- Car Details -->
                <div class="flex items-center gap-y-12">
                    <div class="flex flex-col items-center gap-[2px] px-3 md:px-10" data-aos="fade-left"
                        data-aos-delay="1400">
                        <h6 class="font-bold text-dark text-xl md:text-[26px] text-center">
                            380
                        </h6>
                        <p class="text-sm font-normal text-center md:text-base text-secondary">
                            Horse Power
                        </p>
                    </div>
                    <span class="vr" data-aos="fade-left" data-aos-delay="1600"></span>
                    <div class="flex flex-col items-center gap-[2px] px-3 md:px-10" data-aos="fade-left"
                        data-aos-delay="1900">
                        <h6 class="font-bold text-dark text-xl md:text-[26px] text-center">
                            12S
                        </h6>
                        <p class="text-sm font-normal text-center md:text-base text-secondary">
                            Speed AT
                        </p>
                    </div>
                    <span class="vr" data-aos="fade-left" data-aos-delay="2100"></span>
                    <div class="flex flex-col items-center gap-[2px] px-3 md:px-10" data-aos="fade-left"
                        data-aos-delay="2400">
                        <h6 class="font-bold text-dark text-xl md:text-[26px] text-center">
                            AWD
                        </h6>
                        <p class="text-sm font-normal text-center md:text-base text-secondary">
                            Drive
                        </p>
                    </div>
                    <span class="vr" data-aos="fade-left" data-aos-delay="2600"></span>
                    <div class="flex flex-col items-center gap-[2px] px-3 md:px-10" data-aos="fade-left"
                        data-aos-delay="2900">
                        <h6 class="font-bold text-dark text-xl md:text-[26px] text-center">
                            A.I
                        </h6>
                        <p class="text-sm font-normal text-center md:text-base text-secondary">
                            Tracking
                        </p>
                    </div>
                </div>
                <!-- Button Primary -->
                <div class="p-1 rounded-full bg-primary group" data-aos="zoom-in" data-aos-delay="3400">
                    <a href="checkout.html" class="btn-primary">
                        <p>
                            Booking Sekarang
                        </p>
                        <img src="../assets/svgs/ic-arrow-right.svg" alt="">
                    </a>
                </div>
            </div> --}}
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


                                    <a href="{{ route('front.detail',$detail_paket->id) }}" class="absolute inset-0"></a>

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
        </div>
    </section>

    <!-- Extra Benefits -->
    <section class="container relative pt-[100px]">
        <div class="flex items-center flex-col md:flex-row flex-wrap justify-center gap-8 lg:gap-[120px]">
            <img src="../assets/images/illustration-01.webp" class="w-full lg:max-w-[536px]" alt="">
            <div class="max-w-[268px] w-full">
                <div class="flex flex-col gap-[30px]">
                    <header>
                        <h2 class="font-bold text-dark text-[26px] mb-1">
                            Extra Benefits
                        </h2>
                        <p class="text-base text-secondary">You drive safety and famous</p>
                    </header>
                    <!-- Benefits Item -->
                    <div class="flex items-center gap-4">
                        <div class="bg-dark rounded-[26px] p-[19px]">
                            <img src="../assets/svgs/ic-car.svg" alt="">
                        </div>
                        <div>
                            <h5 class="text-lg text-dark font-bold mb-[2px]">
                                Delivery
                            </h5>
                            <p class="text-sm font-normal text-secondary">Just sit tight and wait</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="bg-dark rounded-[26px] p-[19px]">
                            <img src="../assets/svgs/ic-card.svg" alt="">
                        </div>
                        <div>
                            <h5 class="text-lg text-dark font-bold mb-[2px]">
                                Pricing
                            </h5>
                            <p class="text-sm font-normal text-secondary">12x Pay Installment</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="bg-dark rounded-[26px] p-[19px]">
                            <img src="../assets/svgs/ic-securityuser.svg" alt="">
                        </div>
                        <div>
                            <h5 class="text-lg text-dark font-bold mb-[2px]">
                                Secure
                            </h5>
                            <p class="text-sm font-normal text-secondary">Use your plate number</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="bg-dark rounded-[26px] p-[19px]">
                            <img src="../assets/svgs/ic-convert3dcube.svg" alt="">
                        </div>
                        <div>
                            <h5 class="text-lg text-dark font-bold mb-[2px]">
                                Fast Trade
                            </h5>
                            <p class="text-sm font-normal text-secondary">Change car faster</p>
                        </div>
                    </div>
                </div>
                <!-- CTA Button -->
                <div class="mt-[50px]">
                    <!-- Button Primary -->
                    <div class="p-1 rounded-full bg-primary group">
                        <a href="#!" class="btn-primary">
                            <p>
                                Explore Cars
                            </p>
                            <img src="../assets/svgs/ic-arrow-right.svg" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="container relative py-[100px]">
        <header class="text-center mb-[50px]">
            <h2 class="font-bold text-dark text-[26px] mb-1">
                Frequently Asked Questions
            </h2>
            <p class="text-base text-secondary">Learn more about Vrom and get a success</p>
        </header>

        <!-- Questions -->
        <div class="grid md:grid-cols-2 gap-x-[50px] gap-y-6 max-w-[910px] w-full mx-auto">
            <a href="#!" class="px-6 py-4 border rounded-[24px] border-grey h-min accordion max-w-[430px]"
                id="faq1">
                <div class="flex items-center justify-between gap-1">
                    <p class="text-base font-semibold text-dark">
                        What if I crash the car?
                    </p>
                    <img src="../assets/svgs/ic-chevron-down-rounded.svg" class="transition-all" alt="">
                </div>
                <div class="hidden pt-4 max-w-[335px]" id="faq1-content">
                    <p class="text-base text-dark leading-[26px]">
                        Ipsum top talent busy making race that
                        agreed both party. You can si amet lorem
                        dolor get the rewards after winninng.
                    </p>
                </div>
            </a>
            <a href="#!" class="px-6 py-4 border rounded-[24px] border-grey h-min accordion max-w-[430px]"
                id="faq2">
                <div class="flex items-center justify-between gap-1">
                    <p class="text-base font-semibold text-dark">
                        What if I crash the car?
                    </p>
                    <img src="../assets/svgs/ic-chevron-down-rounded.svg" class="transition-all" alt="">
                </div>
                <div class="hidden pt-4 max-w-[335px]" id="faq2-content">
                    <p class="text-base text-dark leading-[26px]">
                        Ipsum top talent busy making race that
                        agreed both party. You can si amet lorem
                        dolor get the rewards after winninng.
                    </p>
                </div>
            </a>
            <a href="#!" class="px-6 py-4 border rounded-[24px] border-grey h-min accordion max-w-[430px]"
                id="faq3">
                <div class="flex items-center justify-between gap-1">
                    <p class="text-base font-semibold text-dark">
                        What if I crash the car?
                    </p>
                    <img src="../assets/svgs/ic-chevron-down-rounded.svg" class="transition-all" alt="">
                </div>
                <div class="hidden pt-4 max-w-[335px]" id="faq3-content">
                    <p class="text-base text-dark leading-[26px]">
                        Ipsum top talent busy making race that
                        agreed both party. You can si amet lorem
                        dolor get the rewards after winninng.
                    </p>
                </div>
            </a>
            <a href="#!" class="px-6 py-4 border rounded-[24px] border-grey h-min accordion max-w-[430px]"
                id="faq4">
                <div class="flex items-center justify-between gap-1">
                    <p class="text-base font-semibold text-dark">
                        What if I crash the car?
                    </p>
                    <img src="../assets/svgs/ic-chevron-down-rounded.svg" class="transition-all" alt="">
                </div>
                <div class="hidden pt-4 max-w-[335px]" id="faq4-content">
                    <p class="text-base text-dark leading-[26px]">
                        Ipsum top talent busy making race that
                        agreed both party. You can si amet lorem
                        dolor get the rewards after winninng.
                    </p>
                </div>
            </a>
            <a href="#!" class="px-6 py-4 border rounded-[24px] border-grey h-min accordion max-w-[430px]"
                id="faq5">
                <div class="flex items-center justify-between gap-1">
                    <p class="text-base font-semibold text-dark">
                        What if I crash the car?
                    </p>
                    <img src="../assets/svgs/ic-chevron-down-rounded.svg" class="transition-all" alt="">
                </div>
                <div class="hidden pt-4 max-w-[335px]" id="faq5-content">
                    <p class="text-base text-dark leading-[26px]">
                        Ipsum top talent busy making race that
                        agreed both party. You can si amet lorem
                        dolor get the rewards after winninng.
                    </p>
                </div>
            </a>
            <a href="#!" class="px-6 py-4 border rounded-[24px] border-grey h-min accordion max-w-[430px]"
                id="faq6">
                <div class="flex items-center justify-between gap-1">
                    <p class="text-base font-semibold text-dark">
                        What if I crash the car?
                    </p>
                    <img src="../assets/svgs/ic-chevron-down-rounded.svg" class="transition-all" alt="">
                </div>
                <div class="hidden pt-4 max-w-[335px]" id="faq6-content">
                    <p class="text-base text-dark leading-[26px]">
                        Ipsum top talent busy making race that
                        agreed both party. You can si amet lorem
                        dolor get the rewards after winninng.
                    </p>
                </div>
            </a>
        </div>
    </section>

    <!-- Instant Booking -->
    <section class="relative bg-[#060523]">
        <div class="container py-20">
            <div class="flex flex-col">
                <header class="mb-[50px] max-w-[360px] w-full">
                    <h2 class="font-bold text-white text-[26px] mb-4">
                        Drive Yours Today. <br>
                        Drive Faster.
                    </h2>
                    <p class="text-base text-subtlePars">Get an instant booking to catch up whatever your
                        really want to achieve today, yes.</p>
                </header>
                <!-- Button Primary -->
                <div class="p-1 rounded-full bg-primary group w-max">
                    <a href="details.html" class="btn-primary">
                        <p>
                            Book Now
                        </p>
                        <img src="../assets/svgs/ic-arrow-right.svg" alt="">
                    </a>
                </div>
            </div>
            <div class="absolute bottom-[-30px] right-0 lg:w-[764px] max-h-[332px] hidden lg:block">
                <img src="../assets/images/porsche_small.webp" alt="">
            </div>
        </div>
    </section>

</x-front-layout>
