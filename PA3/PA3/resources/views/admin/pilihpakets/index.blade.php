<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pilih Paket') }}
        </h2>
    </x-slot>

    <x-slot name="script">
        <script>
            $(document).ready(function() {
                var datatable = $('#dataTable').DataTable({
                    processing: true,
                    serverSide: true,
                    stateSave: true,
                    ajax: {
                        url: '{!! url()->current() !!}',
                    },
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/id.json',
                        processing: '<div class="flex justify-center items-center"><i class="fas fa-spinner fa-spin fa-2x text-blue-500 mr-2"></i> Memuat data...</div>'
                    },
                    columns: [
                        { data: 'id', name: 'id' },
                        { data: 'nama_paket', name: 'nama_paket' },
                        {
                            data: 'harga',
                            name: 'harga',
                            render: function(data) {
                                return data ? 'Rp ' + Number(data).toLocaleString('id-ID') : '-';
                            }
                        },
                        {
                            data: 'durasi',
                            name: 'durasi',
                            render: function(data) {
                                return data ? data + ' menit' : '-';
                            }
                        },
                        { data: 'jumlah_jetski', name: 'jumlah_jetski' },
                        {
                            data: 'deskripsi',
                            name: 'deskripsi',
                            render: function(data) {
                                return data ? data.substring(0, 50) + (data.length > 50 ? '...' : '') : '-';
                            }
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false,
                            render: function(data, type, row) {
                                return `
                                <div class="flex space-x-2">
                                    <a href="/admin/pilihpakets/${row.id}/edit"
                                        class="action-btn bg-blue-500 hover:bg-blue-600 text-white">
                                        <i class="fas fa-edit mr-1"></i> Edit
                                    </a>
                                    <form class="delete-form" action="/admin/pilihpakets/${row.id}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                            class="action-btn bg-red-500 hover:bg-red-600 text-white delete-btn"
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
                        text: "Paket yang dihapus tidak dapat dikembalikan!",
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
    </x-slot>

    <div class="py-8 px-4">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">

                <div class="flex space-x-3">
                    <a href="{{ route('admin.pilihpakets.create') }}" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 transition-colors flex items-center">
                        <i class="fas fa-plus mr-2"></i> Buat Paket
                    </a>
                </div>
            </div>

            <div class="overflow-hidden shadow sm:rounded-lg">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="overflow-x-auto"> <!-- Added overflow container -->
                    <table id="dataTable" class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Paket</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Durasi</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Jetski</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200"></tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
