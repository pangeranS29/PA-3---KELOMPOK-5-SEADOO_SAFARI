<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <center>
            <h2 class="text-2xl font-bold text-gray-800 leading-tight">
                <?php echo e(__('Edit Detail Paket')); ?>

            </h2>
        </center>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <?php if($errors->any()): ?>
                        <div class="mb-5" role="alert">
                            <div class="px-4 py-2 font-bold text-white bg-red-500 rounded-t">
                                Ada kesalahan!
                            </div>
                            <div class="px-4 py-3 text-red-700 bg-red-100 border border-t-0 border-red-400 rounded-b">
                                <ul>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>
                    <?php endif; ?>

                    <form class="w-full" action="<?php echo e(route('admin.detail_pakets.update', $detail_paket->id)); ?>" method="post" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="paket_jetski_id">
                                    Nama Paket*
                                </label>
                                <select name="paket_jetski_id" id="paket_jetski_id"
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    required>
                                    <option value="" data-harga="" data-deskripsi="" data-stok="" data-durasi="">Pilih Paket</option>
                                    <?php $__currentLoopData = $pilihpakets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pilihpaket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($pilihpaket->id); ?>"
                                            data-harga="<?php echo e($pilihpaket->harga); ?>"
                                            data-deskripsi="<?php echo e($pilihpaket->deskripsi); ?>"
                                            data-stok="<?php echo e($pilihpaket->jumlah_jetski); ?>"
                                            data-durasi="<?php echo e($pilihpaket->durasi); ?>"
                                            <?php echo e($detail_paket->paket_jetski_id == $pilihpaket->id ? 'selected' : ''); ?>>
                                            <?php echo e($pilihpaket->nama_paket); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <p class="text-gray-600 text-xs italic">Masukkan judul paket. Contoh: Paket A, Paket B.</p>
                            </div>
                        </div>

                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="harga">
                                    Harga*
                                </label>
                                <input value="<?php echo e(old('harga', $detail_paket->harga)); ?>" name="harga" id="harga"
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    type="number" placeholder="Harga Paket" required readonly>
                                <p class="text-gray-600 text-xs italic">Masukkan harga paket dalam angka. Contoh: 100000.</p>
                            </div>

                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="deskripsi">
                                    Deskripsi*
                                </label>
                                <textarea name="deskripsi" id="deskripsi"
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    rows="3" placeholder="Deskripsi Paket" required readonly><?php echo e(old('deskripsi', $detail_paket->deskripsi)); ?></textarea>
                                <p class="text-gray-600 text-xs italic">Masukkan deskripsi singkat tentang paket ini.</p>
                            </div>
                        </div>

                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="title">
                                    Jumlah Jetski*
                                </label>
                                <input value="<?php echo e(old('jumlah_jetski', $detail_paket->jumlah_jetski)); ?>" name="jumlah_jetski"
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="jumlah_jetski" type="number" placeholder="Masukkan Jumlah Jetski" required>
                                <p class="text-gray-600 text-xs italic">Masukkan Jumlah Jetski dalam angka. Contoh: 10, 100.</p>
                            </div>

                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="harga_drone">
                                    Harga Drone
                                </label>
                                <input value="<?php echo e(old('harga_drone', $detail_paket->harga_drone)); ?>" name="harga_drone"
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="harga_drone" type="number" placeholder="Masukkan Harga Drone" step=".01">
                                <p class="text-gray-600 text-xs italic">Masukkan Harga Drone</p>
                            </div>
                        </div>

                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="foto">
                                    Foto
                                </label>

                                <?php if($detail_paket->foto): ?>
                                    <div class="mb-4">
                                        <img src="<?php echo e(asset('storage/' . $detail_paket->foto)); ?>"
                                             alt="Foto Paket"
                                             class="w-40 h-40 object-cover rounded-md">
                                        <p class="text-gray-600 text-xs italic mt-2">Foto saat ini</p>
                                    </div>
                                <?php endif; ?>

                                <input name="foto"
                                    class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                    type="file"
                                    accept="image/png, image/jpeg, image/webp">
                                <p class="text-gray-600 text-xs italic">Upload foto baru untuk mengganti foto yang ada</p>
                            </div>
                        </div>

                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3 text-right flex justify-between items-center mb-6">
                                <a href="<?php echo e(url()->previous()); ?>"
                                    class="inline-flex items-center px-4 py-2 bg-blue-500 text-white font-medium rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm-2-9a1 1 0 011.707-.707L9.414 9H16a1 1 0 110 2H9.414l1.293 1.293a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414l3-3A1 1 0 018 9z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Kembali
                                </a>
                                <button type="submit"
                                    class="shadow bg-green-500 hover:bg-green-700 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">
                                    Update Paket
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let paketDropdown = document.getElementById('paket_jetski_id');
            let hargaInput = document.getElementById('harga');
            let deskripsiInput = document.getElementById('deskripsi');
            let stokInput = document.getElementById('jumlah_jetski');
            let durasiInput = document.getElementById('durasi');

            function updateFields() {
                let selectedOption = paketDropdown.options[paketDropdown.selectedIndex];
                hargaInput.value = selectedOption.getAttribute('data-harga') || "";
                deskripsiInput.value = selectedOption.getAttribute('data-deskripsi') || "";
                stokInput.value = selectedOption.getAttribute('data-stok') || "";

                if (durasiInput) {
                    durasiInput.value = selectedOption.getAttribute('data-durasi') || "";
                }
            }

            // Initialize fields on page load
            updateFields();

            // Update fields when package selection changes
            paketDropdown.addEventListener('change', updateFields);
        });
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\PA3\PA-3---KELOMPOK-5-SEADOO_SAFARI\PA3\PA3\resources\views/admin/detail_pakets/edit.blade.php ENDPATH**/ ?>