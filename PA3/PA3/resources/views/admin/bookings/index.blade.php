<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Booking') }}
        </h2>
    </x-slot>

    <x-slot name="script">

        <script>
            $(document).ready(function () {
                var datatable = $('#dataTable').DataTable({
                    processing: true,
                    serverSide: true,
                    stateSave: true,
                    ajax: {
                        url: '{!! url()->current() !!}',
                    },
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/id.json'
                    },
                    columns: [
                        { data: 'id', name: 'id' },
                        { data: 'user.name', name: 'user.name' },
                        { data: 'detail_paket.pilihpaket.nama_paket', name: 'detail_paket.pilihpaket.nama_paket' },
                        { data: 'waktu_mulai', name: 'waktu_mulai' },
                        { data: 'waktu_selesai', name: 'waktu_selesai' },
                        { data: 'jumlah_penumpang', name: 'jumlah_penumpang' },
                        { data: 'status', name: 'status' },
                        { data: 'status_pembayaran', name: 'status_pembayaran' },
                        { data: 'total_harga', name: 'total_harga' },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false,
                            width: '15%'
                        },
                    ],
                });
            });
        </script>
    </x-slot>

    <div class="py-12"> <!-- Padding atas dan bawah sebesar 12 (3rem / 48px) -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> <!-- Lebar maksimal 7xl dan padding horizontal -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6"> <!-- Padding dalam 6 (1.5rem / 24px) -->
                <table id="dataTable" class="mt-6 min-w-full bg-white border border-gray-200 shadow-sm rounded-lg">
                    <!-- Margin atas 6 (1.5rem / 24px) untuk memberikan jarak antara div dan tabel -->
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-4 py-2">ID</th> <!-- Padding horizontal 4 (1rem / 16px), Padding vertikal 2 (0.5rem / 8px) -->
                            <th class="px-4 py-2">User</th>
                            <th class="px-4 py-2">Nama Paket</th>
                            <th class="px-4 py-2">Mulai</th>
                            <th class="px-4 py-2">Selesai</th>
                            <th class="px-4 py-2">Jumlah Penumpang</th>
                            <th class="px-4 py-2">Status Booking</th>
                            <th class="px-4 py-2">Status Pembayaran</th>
                            <th class="px-4 py-2">Total Harga</th>
                            <th class="px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

</x-app-layout>
