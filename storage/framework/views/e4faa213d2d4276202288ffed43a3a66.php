<?php if (isset($component)) { $__componentOriginal9d41032d5dde91ab243771384dacb5df = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9d41032d5dde91ab243771384dacb5df = $attributes; } ?>
<?php $component = App\View\Components\FrontLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('front-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\FrontLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <!-- Main Content -->
    <section class="bg-darkGrey relative py-[70px]" style="background-color: #000000;">
        <div class="container">
            <div class="grid grid-cols-12 gap-[30px]">
                <!-- Car Preview -->
                <div class="col-span-12 lg:col-span-8">
                    <div class="bg-white p-4 rounded-[30px]">
                        <!-- Hanya menampilkan 1 foto utama -->
                        <img src="<?php echo e(asset('storage/' . $detail_paket->foto)); ?>"
                             class="w-full aspect-[16/9] rounded-[18px] object-cover"
                             alt="<?php echo e($detail_paket->pilihpaket ? $detail_paket->pilihpaket->nama_paket : 'Jetski'); ?>">
                    </div>
                </div>

                <!-- Details -->
                <div class="col-span-12 md:col-start-5 lg:col-start-auto md:col-span-8 lg:col-span-4">
                    <div class="bg-white p-5 pb-[30px] rounded-3xl h-full">
                        <div class="flex flex-col h-full divide-y divide-grey">
                            <!-- Name, Category -->
                            <div class="max-w-[230px] ">
                                <h1 class="font-bold text-[24px] leading-[42px] text-dark mb-[6px]">
                                    <?php echo e($detail_paket->pilihpaket ? $detail_paket->pilihpaket->nama_paket : '-'); ?>

                                </h1>
                                <p class="text-secondary font-normal text-base mb-[10px]">
                                </p>
                            </div>

                            <ul class="flex flex-col gap-4 flex-start pt-3 pb-[25px]">
                                <?php
                                    $deskripsi = explode(',', $detail_paket->pilihpaket->deskripsi);
                                ?>
                                <?php $__currentLoopData = $deskripsi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $desk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="flex items-center gap-3 text-base font-semibold text-dark">
                                        <img src="/svgs/ic-checkDark.svg" alt="">
                                        <?php echo e($desk); ?>

                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                            <!-- Price, CTA Button -->
                            <div class="mt-auto pt-4 border-t border-gray-200">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-xl font-bold text-yellow-500">
                                            Rp
                                            <?php echo e(number_format($detail_paket->pilihpaket ? $detail_paket->pilihpaket->harga : 0, 0, ',', '.')); ?>

                                        </p>
                                    </div>
                                    <!-- Tombol Booking -->
                                    <?php if(auth()->guard()->check()): ?>
                                        <a href="<?php echo e(route('front.checkout', $detail_paket->id)); ?>"
                                            class="bg-yellow-500 hover:bg-yellow-600 text-black font-semibold px-6 py-2 rounded-lg transition-colors duration-300">
                                            Pesan Sekarang
                                        </a>
                                    <?php else: ?>
                                        <a href="<?php echo e(route('login', ['redirect_to' => route('front.detail', $detail_paket->id)])); ?>"
                                            class="bg-yellow-500 hover:bg-yellow-600 text-black font-semibold px-6 py-2 rounded-lg transition-colors duration-300">
                                            Pesan Sekarang
                                        </a>
                                    <?php endif; ?>
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
                <?php $__currentLoopData = $similiarItems->shuffle()->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $similiarItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <!-- Card Component -->
                    <div class="bg-dark text-white rounded-3xl overflow-hidden shadow-lg h-full flex flex-col">
                        <!-- Gambar -->
                        <img src="<?php echo e(asset('storage/' . $similiarItem->foto)); ?>"
                            alt="<?php echo e($similiarItem->pilihpaket ? $similiarItem->pilihpaket->nama_paket : 'Jetski'); ?>"
                            class="w-full h-[150px] object-cover">

                        <!-- Konten -->
                        <div class="p-4 flex flex-col flex-grow">
                            <!-- Nama Paket -->
                            <h5 class="text-white text-lg font-bold mb-1">
                                <?php echo e($similiarItem->pilihpaket ? $similiarItem->pilihpaket->nama_paket : '-'); ?>

                            </h5>

                            <!-- Durasi -->
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm text-gray-400">
                                    <?php echo e($similiarItem->pilihpaket ? $similiarItem->pilihpaket->durasi : '-'); ?>/Minutes
                                </span>
                            </div>

                            <!-- Harga & Tombol -->
                            <div class="flex justify-between items-center mt-auto pt-2">
                                <!-- Harga -->
                                <span class="text-yellow-500 font-bold text-base">
                                    Rp.
                                    <?php echo e($similiarItem->pilihpaket ? number_format($similiarItem->pilihpaket->harga, 0, ',', '.') : '-'); ?>

                                </span>

                                <!-- Tombol Book Now -->
                                <?php if(auth()->guard()->check()): ?>
                                    <a href="<?php echo e(route('front.detail', $similiarItem->id)); ?>"
                                        class="bg-yellow-500 hover:bg-yellow-600 text-black text-xs font-semibold px-3 py-1 rounded-md transition">
                                        Pesan Sekarang
                                    </a>
                                <?php else: ?>
                                    <a href="<?php echo e(route('login', ['redirect_to' => route('front.detail', $similiarItem->id)])); ?>"
                                        class="bg-yellow-500 hover:bg-yellow-600 text-black text-xs font-semibold px-3 py-1 rounded-md transition">
                                        Pesan Sekarang
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9d41032d5dde91ab243771384dacb5df)): ?>
<?php $attributes = $__attributesOriginal9d41032d5dde91ab243771384dacb5df; ?>
<?php unset($__attributesOriginal9d41032d5dde91ab243771384dacb5df); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9d41032d5dde91ab243771384dacb5df)): ?>
<?php $component = $__componentOriginal9d41032d5dde91ab243771384dacb5df; ?>
<?php unset($__componentOriginal9d41032d5dde91ab243771384dacb5df); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\PA3\PA-3---KELOMPOK-5-SEADOO_SAFARI\PA3\PA3\resources\views/detail.blade.php ENDPATH**/ ?>