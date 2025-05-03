<x-app-layout>
    <x-slot name="header">
        <!-- Judul Halaman -->
        <center>
            <h2 class="text-2xl font-bold text-gray-800 leading-tight">
                {{ __('Buat Paket') }}
            </h2>
        </center>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if ($errors->any())
                        <div class="mb-5" role="alert">
                            <div class="px-4 py-2 font-bold text-white bg-red-500 rounded-t">
                                Ada kesalahan!
                            </div>
                            <div class="px-4 py-3 text-red-700 bg-red-100 border border-t-0 border-red-400 rounded-b">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <form class="w-full" action="{{ route('admin.pilihpakets.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <!-- Field: Title -->
                            <div class="w-full px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="nama_paket">
                                    Nama Paket*
                                </label>
                                <input value="{{ old('nama_paket') }}" name="nama_paket"
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="nama_paket" type="text" placeholder="Judul Paket" required>
                                <p class="text-gray-600 text-xs italic">Masukkan judul paket. Contoh: Paket A, Paket B.
                                </p>
                            </div>
                        </div>

                        <div class="flex flex-wrap -mx-3 mb-6">
                            <!-- Field: Price -->
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="harga">
                                    Harga*
                                </label>
                                <input value="{{ old('harga') }}" name="harga"
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="harga" type="number" placeholder="Harga Paket" required>
                                <p class="text-gray-600 text-xs italic">Masukkan harga paket dalam angka. Contoh:
                                    100000.</p>
                            </div>

                            <!-- Field: Deskripsi -->
                            <div class="w-full md:w-1/2 px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="deskripsi">
                                    Deskripsi*
                                </label>
                                <textarea name="deskripsi"
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="deskripsi" rows="3" placeholder="Deskripsi Paket" required>{{ old('deskripsi') }}</textarea>
                                <p class="text-gray-600 text-xs italic">Masukkan deskripsi singkat tentang paket ini.
                                </p>
                            </div>
                        </div>

                        <div class="flex flex-wrap -mx-3 mb-6">
                            <!-- Field: Title -->
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="stok">
                                    Jumlah Paket Jetski*
                                </label>
                                <input value="{{ old('jumlah_jetski') }}" name="jumlah_jetski"
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="jumlah_jetski" type="text" placeholder="jumlah_jetski" required>
                                <p class="text-gray-600 text-xs italic">Masukkan Jumlah Paket Jetski
                            </div>

                            <!-- Field: Deskripsi -->
                            <div class="w-full md:w-1/2 px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="stok">
                                    Durasi*
                                </label>
                                <input value="{{ old('durasi') }}" name="durasi"
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="durasi" type="text" placeholder="durasi" required>
                                <p class="text-gray-600 text-xs italic">Masukkan Jumlah Durasi
                            </div>
                        </div>



                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3 text-right flex justify-between items-center mb-6">

                                <!-- Tombol Kembali -->
                                <a href="{{ url()->previous() }}"
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
                                    Simpan Paket
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
