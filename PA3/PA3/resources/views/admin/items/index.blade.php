<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Item') }}
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
                data: 'stock',
                name: 'stock',
              },
              {
                data: 'pilihpaket.title',
                name: 'title',
                orderable: false,
                searchable:false,
              },
              {
                data: 'pilihpaket.price',
                name: 'price'

              },
              {
                data: 'pilihpaket.deskripsi',
                name: 'deskripsi'
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
                <a href="{{ route('admin.items.create') }}"
                   class="px-4 py-2 font-bold text-white bg-green-500 rounded shadow-lg hover:bg-green-700">
                  + Buat Item
                </a>
              </div>
              <div class="overflow-hidden shadow sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                  <table id="dataTable">
                    <thead>
                      <tr>
                        <th style="max-width: 1%">ID</th>
                        <th>Stock <stock>
                        <th>Nama Paket</th>
                        <th>Price</th>
                        <th>Deskripsi</th>
                        <th>Aksi


                      </tr>
                    </thead>
                    <tbody></tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>


</x-app-layout>
