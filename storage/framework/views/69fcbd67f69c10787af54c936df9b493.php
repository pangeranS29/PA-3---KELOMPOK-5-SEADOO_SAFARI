<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    


    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
    <!-- Libraries -->
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.7/dist/flowbite.min.css" />
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css">
    <link rel="stylesheet"
        href="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.10/css/dataTables.checkboxes.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.1/css/select.dataTables.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <link rel="stylesheet" href="<?php echo e(asset('css/booking.css')); ?>">

    <!-- plugins:css -->
    <link rel="stylesheet" href="<?php echo e(asset('vendors/mdi/css/materialdesignicons.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('vendors/ti-icons/css/themify-icons.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('vendors/css/vendor.bundle.base.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('vendors/font-awesome/css/font-awesome.min.css')); ?>">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="<?php echo e(asset('vendors/font-awesome/css/font-awesome.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')); ?>">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="<?php echo e(asset('css/dashboard.css')); ?>">
    <!-- Scripts -->

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.2.8/js/dataTables.rowReorder.min.js"></script>
    <script src="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.10/js/dataTables.checkboxes.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.2.1/js/dataTables.select.min.js"></script>
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script src="https://unpkg.com/flowbite@1.4.7/dist/flowbite.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>



    <!-- Pindahkan ke sebelum penutup </head> -->
    <style>
        .swal2-confirm {
            background-color: #3085d6 !important;
        }

        .swal2-cancel {
            background-color: #d33 !important;
        }
    </style>


    
    <?php if(session()->has('error')): ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '<?php echo e(session('error')); ?>',
            })
        </script>
    <?php endif; ?>

    <?php if(session()->has('success')): ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '<?php echo e(session('success')); ?>',
            })
        </script>
    <?php endif; ?>

    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

</head>

<body class="font-sans antialiased flex">
    <!-- Sidebar -->
    <?php echo $__env->make('components.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!-- Main Content -->
    <div id="main-content" class="flex-1 ml-64">
        <main class="min-h-screen bg-gray-100">
            <!-- Page Heading -->
            <?php if(isset($header)): ?>
                <header class="bg-white shadow px-4 py-3">
                    <div class="mx-auto max-w-7xl flex  items-center">
                        <!-- Hamburger Button -->
                        <button id="hamburger-menu" class="p-2 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16m-7 6h7" />
                            </svg>
                        </button>

                        <div class="text-lg font-semibold">
                            <?php echo e($header); ?>

                        </div>


                    </div>
                </header>
            <?php endif; ?>

            <!-- Page Content -->
            <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <?php echo e($slot); ?>

            </div>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hamburgerMenu = document.getElementById('hamburger-menu');
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');

            // Pastikan sidebar ada sebelum menambahkan event listener
            if (hamburgerMenu && sidebar && mainContent) {
                hamburgerMenu.addEventListener('click', function() {
                    sidebar.classList.toggle('-translate-x-full');
                    mainContent.classList.toggle('ml-64');
                });
            }
        });
    </script>

    <?php echo $__env->yieldPushContent('modals'); ?>

    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- In your layout file (app.blade.php) -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js" defer></script>

    <?php echo e($script ?? ''); ?>

    <?php echo e($modal ?? ''); ?>


</body>

</html>
<?php /**PATH C:\laragon\www\PA3\PA-3---KELOMPOK-5-SEADOO_SAFARI\PA3\PA3\resources\views/layouts/app.blade.php ENDPATH**/ ?>