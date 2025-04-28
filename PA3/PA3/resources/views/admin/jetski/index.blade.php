<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Jetski') }}
        </h2>
    </x-slot>

    <x-slot name="script">
        <script>
            // Initialize DataTable with AJAX
            $(document).ready(function() {
                var datatable = $('#dataTable').DataTable({
                    processing: true,
                    serverSide: true,
                    stateSave: true,
                    ajax: {
                        url: '{!! url()->current() !!}',
                        dataSrc: '' // Ensure we get the data in the correct format
                    },
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/id.json' // Set the language to Bahasa Indonesia
                    },
                    columns: [
                        { data: 'id', name: 'id' },
                        { data: 'booking.nama_customer', name: 'booking.nama_customer' },
                        { data: 'status_jetski', name: 'status_jetski' },
                        { data: 'jumlah_jetski', name: 'jumlah_jetski' },
                        { data: 'waktu_mulai', name: 'waktu_mulai' },
                        { data: 'waktu_selesai', name: 'waktu_selesai' },
                    ],
                    order: [[0, 'desc']] // Default ordering by ID, you can change this if needed
                });
            });
        </script>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="mb-10">
                {{-- <a href="{{ route('admin.pilihpakets.create') }}"
                   class="px-4 py-2 font-bold text-white bg-green-500 rounded shadow-lg hover:bg-green-700">
                  + Buat Paket
                </a> --}}
            </div>

            <div class="overflow-hidden shadow sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <table id="dataTable" class="table table-striped table-bordered w-full">
                        <thead>
                            <tr>
                                <th style="max-width: 1%">ID</th>
                                <th>Nama Customer</th>
                                <th>Status Jetski</th>
                                <th>Jumlah Jetski</th>
                                <th>Waktu Mulai</th>
                                <th>Waktu Selesai</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
