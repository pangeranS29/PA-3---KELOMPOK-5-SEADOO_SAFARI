<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Jetski') }}
        </h2>
    </x-slot>



    <x-slot name="script">
        <script>
          // AJAX DataTable
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
                name: 'id',
              },
              {
                data: 'user.name',
                name: 'user.name',
              },
              {
                data: 'status_jetski',
                name: 'status_jetski'
              },
              {
                data: 'status_jetski',
                name: 'status_jetski'
              },
              {
                data: 'pilihpaket.jumlah_jetski',
                name: 'jumlah_jetski'
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
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
                width: '15%'
              },
            ],
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
                  <table id="dataTable">
                    <thead>
                      <tr>
                        <th style="max-width: 1%">ID</th>
                        <th>Nama_Customer</th>
                        <th>Status_jetski</th>
                        <th>Jumlah_jetski</th>
                        <th>waktu_mulai</th>
                        <th>waktu_selesai</th>
                        <th>Aksi </th>


                      </tr>
                    </thead>
                    <tbody></tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>


</x-app-layout>
