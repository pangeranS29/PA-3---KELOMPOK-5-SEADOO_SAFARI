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
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <?php echo e(__('Detail Paket')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

     <?php $__env->slot('script', null, []); ?> 
        <script>
            $(document).ready(function() {
                var datatable = $('#dataTable').DataTable({
                    processing: true,
                    serverSide: true,
                    stateSave: true,
                    ajax: {
                        url: '<?php echo url()->current(); ?>',
                    },
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/id.json',
                        processing: '<div class="flex justify-center items-center"><i class="fas fa-spinner fa-spin fa-2x text-blue-500 mr-2"></i> Memuat data...</div>'
                    },
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'pilihpaket.nama_paket',
                            name: 'nama_paket',
                            render: function(data) {
                                return data || '-';
                            }
                        },
                        {
                            data: 'pilihpaket.harga',
                            name: 'harga',
                            render: function(data) {
                                return data ? 'Rp ' + Number(data).toLocaleString('id-ID') : '-';
                            }
                        },
                        {
                            data: 'pilihpaket.deskripsi',
                            name: 'deskripsi',
                            render: function(data) {
                                return data ? data.substring(0, 50) + (data.length > 50 ? '...' : '') :
                                    '-';
                            }
                        },
                        {
                            data: 'pilihpaket.jumlah_jetski',
                            name: 'jumlah_jetski',
                            render: function(data) {
                                return data || '-';
                            }
                        },
                        {
                            data: 'foto',
                            name: 'foto',
                            orderable: false,
                            searchable: false
                        },
                         {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false,
                            render: function(data, type, row) {
                                return `
                                <div class="flex space-x-2">
                                    <a href="/admin/detail_pakets/${row.id}/edit"
                                        class="px-3 py-1 text-sm bg-blue-500 hover:bg-blue-600 text-white rounded-md flex items-center">
                                        <i class="fas fa-edit mr-1"></i> Edit
                                    </a>
                                    <form class="delete-form" action="/admin/detail_pakets/${row.id}" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="button"
                                            class="px-3 py-1 text-sm bg-red-500 hover:bg-red-600 text-white rounded-md flex items-center delete-btn"
                                            data-id="${row.id}">
                                            <i class="fas fa-trash mr-1"></i> Hapus
                                        </button>
                                    </form>
                                </div>`;
                            }
                        },
                    ],
                });

                // Delete confirmation
                $(document).on('click', '.delete-btn', function() {
                    const form = $(this).closest('form');

                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Data akan dihapus secara permanen!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        </script>
     <?php $__env->endSlot(); ?>

    <div class="py-8 px-4">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <div class="flex space-x-3">
                    <a href="<?php echo e(route('admin.detail_pakets.create')); ?>"
                        class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 transition-colors flex items-center">
                        <i class="fas fa-plus mr-2"></i> Buat Detail Paket
                    </a>
                </div>
            </div>

            <div class="overflow-hidden shadow sm:rounded-lg">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="overflow-x-auto">
                        <table id="dataTable" class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        ID</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nama Paket</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Harga</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Deskripsi</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Jumlah Jetski</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Foto</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
<?php /**PATH C:\laragon\www\PA3\PA-3---KELOMPOK-5-SEADOO_SAFARI\PA3\PA3\resources\views/admin/detail_pakets/index.blade.php ENDPATH**/ ?>