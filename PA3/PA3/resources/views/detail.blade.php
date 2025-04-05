<x-front-layout>
    <!-- Main Content -->
    <section class="bg-darkGrey relative py-[70px]" style="background-color: #000000;">
        <div class="container">
            {{-- <!-- Breadcrumb -->
            <ul class="flex items-center gap-5 mb-[50px]">
                <li
                    class="text-secondary font-normal text-base capitalize after:content-['/'] last:after:content-none inline-flex gap-5">
                    <a href="./index.html">Home</a>
                </li>
                <li
                    class="text-secondary font-normal text-base capitalize after:content-['/'] last:after:content-none inline-flex gap-5">
                    <a href="#!">Porsche</a>
                </li>
                <li
                    class="text-dark font-semibold text-base capitalize after:content-['/'] last:after:content-none inline-flex gap-5">
                    Details
                </li>
            </ul> --}}

            <div class="grid grid-cols-12 gap-[30px]">
                <!-- Car Preview -->
                <div class="col-span-12 lg:col-span-8">
                    <div class="bg-white p-4 rounded-[30px] flex flex-col gap-4" id="gallery">
                        <img :src="thumbnails[activeThumbnail].url" :key="thumbnails[activeThumbnail].id"
                            class="md:h-[490px] rounded-[18px] h-auto w-full" alt="">
                        <div class="grid items-center grid-cols-4 gap-3 md:gap-5">
                            <div v-for="(thumbnail, index) in thumbnails" :key="thumbnail.id">
                                <a href="#!" @click="changeActive(index)">
                                    <img :src="thumbnail.url" alt="" class="thumbnail"
                                        :class="{ selected: index == activeThumbnail }">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Details -->
                <div class="col-span-12 md:col-start-5 lg:col-start-auto md:col-span-8 lg:col-span-4">
                    <div class="bg-white p-5 pb-[30px] rounded-3xl h-full">
                        <div class="flex flex-col h-full divide-y divide-grey">
                            <!-- Name, Category, Rating -->
                            <div class="max-w-[230px] pb-5">
                                <h1 class="font-bold text-[28px] leading-[42px] text-dark mb-[6px]">
                                    {{ $detail_paket->pilihpaket ? $detail_paket->pilihpaket->nama_paket : '-' }}
                                </h1>
                                <p class="text-secondary font-normal text-base mb-[10px]">
                                    {{ $detail_paket->pilihpaket ? $detail_paket->pilihpaket->durasi : '-' }}/Minutes
                                </p>
                                <div class="flex items-center gap-2">
                                    <span class="flex items-center gap-1">
                                        @for ($i = 0; $i < floor($detail_paket->rating); $i++)
                                            <img src="/svgs/ic-star.svg" class="h-[22px] w-[22px]" alt="">
                                        @endfor

                                    </span>
                                    <p class="text-base font-semibold text-dark mt-[2px]">
                                        ({{  $detail_paket->rating }})
                                    </p>
                                </div>
                            </div>

                            <ul class="flex flex-col gap-4 flex-start pt-3 pb-[25px]">
                                @php
                                $deskripsi = explode(',', $detail_paket->deskripsi);
                              @endphp
                              @foreach ($deskripsi as $desk)
                                <li class="flex items-center gap-3 text-base font-semibold text-dark">
                                  <img src="/svgs/ic-checkDark.svg" alt="">
                                  {{ $desk }}
                                </li>


                              @endforeach


                            </ul>
                            <!-- Price, CTA Button -->
                            <div class="flex items-center justify-between gap-4 pt-5 mt-auto">
                                <div>
                                    <p class="font-bold text-yellow-500 text-[22px]">
                                        Rp.  {{ $detail_paket->pilihpaket ? $detail_paket->pilihpaket->harga : '-' }}
                                    </p>

                                </div>
                                <div class="w-full max-w-[70%]">
                                    <!-- Button Primary -->
                                    <div class="flex justify-end p-1">
                                        <a href="{{ route('front.checkout', $detail_paket->id) }}" class="bg-black text-white text-sm font-semibold px-4 py-2 rounded-lg hover:bg-gray-800 inline-block">
                                            Book Now
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- <!-- FAQ -->
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
    </section> --}}

    <!-- Similar Cars -->
    <section class="bg-darkGrey">
        <div class="container relative py-[100px]">
            <header class="mb-[30px]">
                <h2 class="font-bold text-dark text-[26px] mb-1">
                    Similar Jetski
                </h2>
                <p class="text-base text-secondary">Start your big day</p>
            </header>

            <!-- Cars -->
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-[29px]">
                @foreach ($similiarItems as $similiarItem)
                    <!-- Card -->
                    <div class="card-popular">
                        <div>
                            <div class="">
                                <h5 class="text-lg text-dark font-bold mb-[2px]">
                                    {{ $similiarItem->pilihpaket ? $similiarItem->pilihpaket->nama_paket : '-' }}

                                </h5>
                                <div class="flex items-center justify-between gap-1">
                                    <p class="text-sm font-normal text-secondary"> {{ $similiarItem->pilihpaket ? $similiarItem->pilihpaket->durasi : '-' }}/Minutes </p>



                                    <p class="text-dark text-xs font-semibold flex items-center gap-[2px]">
                                        ({{ $similiarItem->rating }}/5)
                                        <img src="/svgs/ic-star.svg" alt="">
                                    </p>



                                </div>

                            </div>

                            <a href="{{ route('front.detail',$similiarItem->id) }}" class="absolute inset-0"></a>
                        </div>
                        <img src="{{ $similiarItem->thumbnail}}" class="rounded-[18px] min-w-[216px] w-full h-[150px]"
                            alt="">
                        <div class="flex items-center justify-between gap-1">
                            <!-- Price -->
                            <p class="text-sm font-normal text-secondary">
                                <span class="text-yellow-500 text-base font-bold ">Rp.  {{ $similiarItem->pilihpaket ? $similiarItem->pilihpaket->harga : '-' }}
                            </p>

                            <button class="bg-black text-white text-sm font-semibold px-4 py-2 rounded-lg hover:bg-black">
                                Book Now
                            </button>



                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/vue@3/dist/vue.global.js"></script>

    <script>
        const {
          createApp
        } = Vue
        createApp({
          data() {
            return {
              activeThumbnail: 0,
              thumbnails: [
                @foreach (json_decode($detail_paket->foto) as $key => $foto)
                  {
                    id: {{ $key }},
                    url: "{{ Storage::url($foto) }}"
                  },
                @endforeach
              ],
            }
          },
          methods: {
            changeActive(id) {
              this.activeThumbnail = id;
            }
          }
        }).mount('#gallery')
      </script>



</x-front-layout>
