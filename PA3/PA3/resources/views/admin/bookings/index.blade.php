<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Booking') }}
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
                        url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/id.json'
                    },
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'user_name',
                            name: 'user_name'
                        },
                        {
                            data: 'nama_paket',
                            name: 'nama_paket'
                        },
                        {
                            data: 'waktu_mulai',
                            name: 'waktu_mulai'
                        },
                        {
                            data: 'waktu_selesai',
                            name: 'waktu_selesai'
                        },
                        {
                            data: 'jumlah_penumpang',
                            name: 'jumlah_penumpang'
                        },
                        {
                            data: 'status_pembayaran',
                            name: 'status_pembayaran'
                        },
                        {
                            data: 'total_harga',
                            name: 'total_harga'
                        },
                        {
                            data: 'bukti_pembayaran',
                            name: 'bukti_pembayaran',
                            render: function(data) {
                                return data ?
                                    `<a href="/storage/${data}" target="_blank" class="text-blue-600 hover:underline">Lihat Bukti</a>` :
                                    '-';
                            }
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false,
                            width: '10%'
                        },
                    ]
                });

                // Preview modal
                $(document).on('click', '.preview-btn', function() {
                    const imageUrl = $(this).data('image');
                    const bookingId = $(this).data('id');
                    const phoneNumber = $(this).data('phone');
                    const currentStatus = $(this).data('status');

                    $('#previewImage').attr('src', imageUrl);
                    $('#bookingId').val(bookingId);
                    $('#phoneNumber').val(phoneNumber);

                    // Show/hide buttons based on current status
                    if (currentStatus === 'pending') {
                        $('#actionButtons').show();
                    } else {
                        $('#actionButtons').hide();
                    }

                    $('#rejectForm').hide();
                    $('#previewModal').removeClass('hidden');
                });

                // Close modal
                $('#closeModal').click(function() {
                    $('#previewModal').addClass('hidden');
                });

                // Accept booking
                $('#acceptBtn').click(function() {
                    const bookingId = $('#bookingId').val();

                    $.ajax({
                        url: `/admin/bookings/${bookingId}/accept`,
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            alert('Status pembayaran berhasil diubah menjadi success');
                            datatable.ajax.reload();
                            $('#previewModal').addClass('hidden');
                        },
                        error: function(error) {
                            alert('Terjadi kesalahan');
                        }
                    });
                });

                // Show reject form
                $('#rejectBtn').click(function() {
                    $('#rejectForm').show();
                    $('#rejectReason').focus();
                });

                // Submit reject
                $('#submitReject').click(function() {
                    const bookingId = $('#bookingId').val();
                    const rejectReason = $('#rejectReason').val();

                    if (!rejectReason) {
                        alert('Silakan isi alasan penolakan');
                        return;
                    }

                    $.ajax({
                        url: `/admin/bookings/${bookingId}/reject`,
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            reason: rejectReason
                        },
                        success: function(response) {
                            // Open WhatsApp with rejection message
                            window.open(response.whatsapp_url, '_blank');

                            alert('Status pembayaran berhasil diubah menjadi rejected');
                            datatable.ajax.reload();
                            $('#previewModal').addClass('hidden');
                            $('#rejectForm').hide();
                            $('#rejectReason').val('');
                        },
                        error: function(error) {
                            alert('Terjadi kesalahan');
                        }
                    });
                });
            });
        </script>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table id="dataTable" class="mt-6 min-w-full bg-white border border-gray-200 shadow-sm rounded-lg">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-4 py-2">ID</th>
                            <th class="px-4 py-2">User</th>
                            <th class="px-4 py-2">Nama Paket</th>
                            <th class="px-4 py-2">Mulai</th>
                            <th class="px-4 py-2">Selesai</th>
                            <th class="px-4 py-2">Jumlah Penumpang</th>
                            <th class="px-4 py-2">Status Pembayaran</th>
                            <th class="px-4 py-2">Total Harga</th>
                            <th class="px-4 py-2">Bukti Pembayaran</th>
                            <th class="px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Preview Modal -->
    <div id="previewModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-1/2 lg:w-1/3 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Preview Bukti Pembayaran</h3>
                <div class="mt-2 px-7 py-3">
                    <img id="previewImage" src="" alt="Bukti Pembayaran" class="mx-auto max-h-64">
                </div>
                <input type="hidden" id="bookingId">
                <input type="hidden" id="phoneNumber">

                <div id="actionButtons" class="mt-4">
                    <button id="acceptBtn"
                        class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 focus:outline-none">
                        Terima Pembayaran
                    </button>
                    <button id="rejectBtn"
                        class="ml-2 px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 focus:outline-none">
                        Tolak Pembayaran
                    </button>
                </div>

                <div id="rejectForm" class="mt-4 hidden">
                    <textarea id="rejectReason" rows="3" class="w-full border rounded-md p-2"
                        placeholder="Masukkan alasan penolakan..."></textarea>
                    <div class="mt-2 text-sm text-gray-600">
                        Pesan penolakan akan dikirim ke nomor customer dan akan menyertakan nomor admin:
                        <span class="font-semibold">{{ env('ADMIN_PHONE', '085763189029') }}</span>
                    </div>
                    <button id="submitReject"
                        class="mt-2 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none">
                        Kirim Penolakan
                    </button>
                </div>

                <div class="mt-4">
                    <button id="closeModal"
                        class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 focus:outline-none">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
