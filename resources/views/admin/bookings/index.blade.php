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
                        processing: '<div class="flex justify-center items-center"><i class="fas fa-spinner fa-spin fa-2x text-blue-500 mr-2"></i> Memuat data...</div>'
                    },
                    dom: '<"flex justify-between items-center mb-4"<"flex"l><"flex"f>>rt<"flex justify-between items-center mt-4"<"flex"i><"flex"p>>',
                    lengthMenu: [
                        [10, 25, 50, 100, -1],
                        [10, 25, 50, 100, "Semua"]
                    ],
                    pageLength: 25,
                    columns: [{
                            data: 'id',
                            name: 'id',
                            className: 'text-sm text-gray-900'
                        },
                        {
                            data: 'user_name',
                            name: 'user_name',
                            className: 'text-sm text-gray-900'
                        },
                        {
                            data: 'phone',
                            name: 'phone',
                            className: 'text-sm text-gray-900'
                        },
                        {
                            data: 'nama_paket',
                            name: 'nama_paket',
                            className: 'text-sm text-gray-900'
                        },
                        {
                            data: 'waktu_mulai',
                            name: 'waktu_mulai',
                            className: 'text-sm text-gray-900'
                        },
                        {
                            data: 'waktu_selesai',
                            name: 'waktu_selesai',
                            className: 'text-sm text-gray-900'
                        },
                        {
                            data: 'status_pembayaran',
                            name: 'status_pembayaran',
                            className: 'text-sm',
                            render: function(data) {
                                let color, text;

                                // Determine color and display text based on status
                                switch (data) {
                                    case 'success':
                                        color = 'bg-green-100 text-green-800';
                                        text = 'Berhasil';
                                        break;
                                    case 'expired':
                                        color = 'bg-red-100 text-red-800';
                                        text = 'Kedaluwarsa';
                                        break;
                                    case 'menunggu_konfirmasi':
                                        color = 'bg-yellow-100 text-yellow-800';
                                        text = 'Menunggu Konfirmasi';
                                        break;
                                    case 'canceled':
                                        color = 'bg-yellow-100 text-yellow-800';
                                        text = 'Dibatalkan';
                                        break;
                                    case 'pending':
                                        color = 'bg-gray-100 text-gray-800';
                                        text = 'Tertunda';
                                        break;
                                    case 'rejected':
                                        color = 'bg-red-100 text-red-800';
                                        text = 'Ditolak';
                                        break;
                                    case 'meminta_refund':
                                        color = 'bg-purple-100 text-purple-800';
                                        text = 'Menunggu Refund';
                                        break;
                                    case 'refunded':
                                        color = 'bg-blue-100 text-blue-800';
                                        text = 'Sudah Direfund';
                                        break;
                                    default:
                                        color = 'bg-gray-100 text-gray-800';
                                        text = data;
                                }

                                return `<span class="px-2 py-1 rounded-full text-xs font-medium ${color}">${text}</span>`;
                            }
                        },
                        {
                            data: 'total_harga',
                            name: 'total_harga',
                            className: 'text-sm text-gray-900 font-medium',
                            render: function(data) {
                                return data ? 'Rp ' + Number(data).toLocaleString('id-ID') : '-';
                            }
                        },
                        {
                            data: 'bukti_pembayaran',
                            name: 'bukti_pembayaran',
                            className: 'text-sm',
                            render: function(data) {
                                return data ?
                                    `<a href="/storage/${data}" target="_blank" class="text-blue-600 hover:text-blue-800 hover:underline">Lihat Bukti</a>` :
                                    '-';
                            }
                        },
                        {
                            data: 'action',
                            name: 'action',
                            className: 'text-sm',
                            orderable: false,
                            searchable: false,
                            width: '120px'
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
                    $('#refundBookingId').val(bookingId);
                    $('#phoneNumber').val(phoneNumber);

                    // Reset semua form
                    $('#actionButtons').hide();
                    $('#rejectForm').hide();
                    $('#refundForm').hide();

                    // Tampilkan tombol sesuai status
                    if (currentStatus === 'menunggu_konfirmasi' || currentStatus === 'rejected') {
                        $('#actionButtons').show();
                    } else if (currentStatus === 'meminta_refund') {
                        $('#refundForm').show();
                    }

                    $('#previewModal').removeClass('hidden');
                });

                // Proses refund
                $('#processRefundForm').on('submit', function(e) {
                    e.preventDefault();

                    const bookingId = $('#refundBookingId').val();
                    const formData = new FormData(this);

                    Swal.fire({
                        title: 'Konfirmasi Refund',
                        text: 'Apakah Anda yakin ingin memproses refund ini?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Proses Refund',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: `/admin/bookings/${bookingId}/process-refund`,
                                method: 'POST',
                                data: formData,
                                processData: false,
                                contentType: false,
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(response) {
                                    // Open WhatsApp with refund confirmation
                                    window.open(response.whatsapp_url, '_blank');

                                    Swal.fire({
                                        title: 'Berhasil!',
                                        text: 'Refund berhasil diproses dan customer telah diberitahu',
                                        icon: 'success',
                                        confirmButtonText: 'OK'
                                    });

                                    datatable.ajax.reload();
                                    $('#previewModal').addClass('hidden');
                                },
                                error: function(error) {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: error.responseJSON.message ||
                                            'Terjadi kesalahan saat memproses refund',
                                        icon: 'error',
                                        confirmButtonText: 'OK'
                                    });
                                }
                            });
                        }
                    });
                });

                // Cancel refund
                $('#cancelRefund').click(function() {
                    $('#refundForm').hide();
                });


                // Close modal
                $('#closeModal').click(function() {
                    $('#previewModal').addClass('hidden');
                });

                // Accept booking
                $('#acceptBtn').click(function() {
                    const bookingId = $('#bookingId').val();

                    Swal.fire({
                        title: 'Konfirmasi',
                        text: 'Apakah Anda yakin ingin menerima pembayaran ini?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Terima',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: `/admin/bookings/${bookingId}/accept`,
                                method: 'POST',
                                data: {
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function(response) {
                                    // Open WhatsApp with confirmation message
                                    window.open(response.whatsapp_url, '_blank');

                                    Swal.fire({
                                        title: 'Berhasil!',
                                        text: 'Status pembayaran berhasil diubah menjadi success dan customer telah diberitahu',
                                        icon: 'success',
                                        confirmButtonText: 'OK'
                                    });
                                    datatable.ajax.reload();
                                    $('#previewModal').addClass('hidden');
                                },
                                error: function(error) {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'Terjadi kesalahan',
                                        icon: 'error',
                                        confirmButtonText: 'OK'
                                    });
                                }
                            });
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
                        Swal.fire({
                            title: 'Peringatan!',
                            text: 'Silakan isi alasan penolakan',
                            icon: 'warning',
                            confirmButtonText: 'OK'
                        });
                        return;
                    }

                    Swal.fire({
                        title: 'Konfirmasi',
                        text: 'Apakah Anda yakin ingin menolak pembayaran ini?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Tolak',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
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

                                    Swal.fire({
                                        title: 'Berhasil!',
                                        text: 'Status pembayaran berhasil diubah menjadi rejected',
                                        icon: 'success',
                                        confirmButtonText: 'OK'
                                    });
                                    datatable.ajax.reload();
                                    $('#previewModal').addClass('hidden');
                                    $('#rejectForm').hide();
                                    $('#rejectReason').val('');
                                },
                                error: function(error) {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'Terjadi kesalahan',
                                        icon: 'error',
                                        confirmButtonText: 'OK'
                                    });
                                }
                            });
                        }
                    });
                });
            });
        </script>
    </x-slot>

    <div class="py-8"> <!-- Reduced padding from py-12 to py-8 -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"> <!-- Added horizontal padding -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="overflow-x-auto"> <!-- Added overflow container -->
                    <table id="dataTable" class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    ID</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    User</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    No Telepon</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama Paket</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Mulai</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Selesai</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Total Harga</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Bukti</th>
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

    <!-- Preview Modal -->
    <div id="previewModal"
        class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Preview Bukti Pembayaran</h3>
                    <button id="closeModal" class="text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <div class="mb-4">
                    <img id="previewImage" src="" alt="Bukti Pembayaran"
                        class="mx-auto max-h-64 rounded-md border border-gray-200">
                </div>

                <input type="hidden" id="bookingId">
                <input type="hidden" id="phoneNumber">

                <div id="actionButtons" class="mt-4 flex">
                    <button id="acceptBtn"
                        class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 focus:outline-none transition-colors">
                        Terima Pembayaran
                    </button>
                    <button id="rejectBtn"
                        class="ml-auto px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 focus:outline-none transition-colors">
                        Tolak Pembayaran
                    </button>
                </div>

                <div id="rejectForm" class="mt-4 hidden">
                    <label for="rejectReason" class="block text-sm font-medium text-gray-700 mb-1">Alasan
                        Penolakan</label>
                    <textarea id="rejectReason" rows="3"
                        class="w-full border rounded-md p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                    <div class="mt-2 text-sm text-gray-600">
                        Pesan penolakan akan dikirim ke nomor customer dan akan menyertakan nomor admin:
                        <span class="font-semibold">{{ env('ADMIN_PHONE', '085763189029') }}</span>
                    </div>
                    <div class="mt-4 flex justify-end space-x-2">
                        <button id="cancelReject"
                            class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400 focus:outline-none transition-colors">
                            Batal
                        </button>
                        <button id="submitReject"
                            class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none transition-colors">
                            <i class="fas fa-paper-plane mr-2"></i> Kirim Penolakan
                        </button>
                    </div>
                </div>
                <!-- Form Refund (muncul hanya untuk status meminta_refund) -->
                <div id="refundForm" class="mt-4 hidden">
                    <form id="processRefundForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="booking_id" id="refundBookingId">

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Bukti Transfer Refund</label>
                            <input type="file" name="refund_proof" id="refundProof"
                                class="block w-full text-sm text-gray-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-md file:border-0
                                file:text-sm file:font-semibold
                                file:bg-blue-50 file:text-blue-700
                                hover:file:bg-blue-100"
                                required>
                            <p class="mt-1 text-xs text-gray-500">Upload bukti transfer refund (format: JPG, PNG, PDF)
                            </p>
                        </div>

                        <div class="mb-4">
                            <label for="refundNote" class="block text-sm font-medium text-gray-700 mb-1">Catatan
                                Refund</label>
                            <textarea id="refundNote" name="refund_note" rows="3"
                                class="w-full border rounded-md p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Berikan catatan tentang refund ini"></textarea>
                        </div>

                        <div class="flex justify-end space-x-2 mt-4">
                            <button type="button" id="cancelRefund"
                                class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400 focus:outline-none transition-colors">
                                Batal
                            </button>
                            <button type="submit" id="submitRefund"
                                class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 focus:outline-none transition-colors">
                                <i class="fas fa-check mr-2"></i> Proses Refund
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
