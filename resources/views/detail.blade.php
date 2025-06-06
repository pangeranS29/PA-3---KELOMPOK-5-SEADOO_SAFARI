<x-front-layout>
    <!-- Main Content -->
    <section class="bg-darkGrey relative py-[70px]" style="background-color: #000000;">
        <div class="container">
            <div class="grid grid-cols-12 gap-[30px]">
                <!-- Car Preview -->
                <div class="col-span-12 lg:col-span-8">
                    <div class="bg-white p-4 rounded-[30px]">
                        <!-- Hanya menampilkan 1 foto utama -->
                        <img src="{{ asset('storage/' . $detail_paket->foto) }}"
                             class="w-full aspect-[16/9] rounded-[18px] object-cover"
                             alt="{{ $detail_paket->pilihpaket ? $detail_paket->pilihpaket->nama_paket : 'Jetski' }}">
                    </div>
                </div>

                <!-- Details -->
                <div class="col-span-12 md:col-start-5 lg:col-start-auto md:col-span-8 lg:col-span-4">
                    <div class="bg-white p-5 pb-[30px] rounded-3xl h-full">
                        <div class="flex flex-col h-full divide-y divide-grey">
                            <!-- Name, Category -->
                            <div class="max-w-[230px] ">
                                <h1 class="font-bold text-[24px] leading-[42px] text-dark mb-[6px]">
                                    {{ $detail_paket->pilihpaket ? $detail_paket->pilihpaket->nama_paket : '-' }}
                                </h1>
                                <p class="text-secondary font-normal text-base mb-[10px]">
                                </p>
                            </div>

                            <ul class="flex flex-col gap-4 flex-start pt-3 pb-[25px]">
                                @php
                                    $deskripsi = explode(',', $detail_paket->pilihpaket->deskripsi);
                                @endphp
                                @foreach ($deskripsi as $desk)
                                    <li class="flex items-center gap-3 text-base font-semibold text-dark">
                                        <img src="/svgs/ic-checkDark.svg" alt="">
                                        {{ $desk }}
                                    </li>
                                @endforeach
                            </ul>
                            <!-- Price, CTA Button -->
                            <div class="mt-auto pt-4 border-t border-gray-200">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-xl font-bold text-yellow-500">
                                            Rp
                                            {{ number_format($detail_paket->pilihpaket ? $detail_paket->pilihpaket->harga : 0, 0, ',', '.') }}
                                        </p>
                                    </div>
                                    <!-- Tombol Booking -->
                                    @auth
                                        <a href="{{ route('front.checkout', $detail_paket->id) }}"
                                            class="bg-yellow-500 hover:bg-yellow-600 text-black font-semibold px-6 py-2 rounded-lg transition-colors duration-300">
                                            Pesan Sekarang
                                        </a>
                                    @else
                                        <a href="{{ route('login', ['redirect_to' => route('front.detail', $detail_paket->id)]) }}"
                                            class="bg-yellow-500 hover:bg-yellow-600 text-black font-semibold px-6 py-2 rounded-lg transition-colors duration-300">
                                            Pesan Sekarang
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Similar Cars -->
    <section class="bg-black">
        <div class="container relative py-[100px]">
            <header class="mb-[30px] text-center">
                <h2 class="font-bold text-white text-[26px] mb-1">Similar Jetski</h2>
                <p class="text-white text-secondary">Start your big day</p>
            </header>

            <!-- Cars -->
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-[29px]">
                @foreach ($similiarItems->shuffle()->take(4) as $similiarItem)
                    <!-- Card Component -->
                    <div class="bg-dark text-white rounded-3xl overflow-hidden shadow-lg h-full flex flex-col">
                        <!-- Gambar -->
                        <img src="{{ asset('storage/' . $similiarItem->foto) }}"
                            alt="{{ $similiarItem->pilihpaket ? $similiarItem->pilihpaket->nama_paket : 'Jetski' }}"
                            class="w-full h-[150px] object-cover">

                        <!-- Konten -->
                        <div class="p-4 flex flex-col flex-grow">
                            <!-- Nama Paket -->
                            <h5 class="text-white text-lg font-bold mb-1">
                                {{ $similiarItem->pilihpaket ? $similiarItem->pilihpaket->nama_paket : '-' }}
                            </h5>

                            <!-- Durasi -->
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm text-gray-400">
                                    {{ $similiarItem->pilihpaket ? $similiarItem->pilihpaket->durasi : '-' }}/Minutes
                                </span>
                            </div>

                            <!-- Harga & Tombol -->
                            <div class="flex justify-between items-center mt-auto pt-2">
                                <!-- Harga -->
                                <span class="text-yellow-500 font-bold text-base">
                                    Rp.
                                    {{ $similiarItem->pilihpaket ? number_format($similiarItem->pilihpaket->harga, 0, ',', '.') : '-' }}
                                </span>

                                <!-- Tombol Book Now -->
                                @auth
                                    <a href="{{ route('front.detail', $similiarItem->id) }}"
                                        class="bg-yellow-500 hover:bg-yellow-600 text-black text-xs font-semibold px-3 py-1 rounded-md transition">
                                        Pesan Sekarang
                                    </a>
                                @else
                                    <a href="{{ route('login', ['redirect_to' => route('front.detail', $similiarItem->id)]) }}"
                                        class="bg-yellow-500 hover:bg-yellow-600 text-black text-xs font-semibold px-3 py-1 rounded-md transition">
                                        Pesan Sekarang
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</x-front-layout>
