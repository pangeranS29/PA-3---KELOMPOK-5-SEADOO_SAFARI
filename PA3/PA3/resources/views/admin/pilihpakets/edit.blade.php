<x-app-layout>
    <x-slot name="title">Admin</x-slot>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{-- <a href="#!" onclick="window.history.go(-1); return false;" class="text-gray-500 hover:text-gray-700">
                ← Kembali
            </a> --}}
            {!! __('Pilih Paket &raquo; Edit &raquo; #') . $pilihpaket->id . ' &middot; ' . $pilihpaket->nama_paket !!}
        </h2>
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

                    <form class="w-full" action="{{ route('admin.pilihpakets.update', $pilihpaket->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        <!-- Field: Title -->
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="nama_paket">
                                    Nama Paket*
                                </label>
                                <input value="{{ old('nama_paket', $pilihpaket->nama_paket) }}" name="nama_paket"
                                       class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                       id="nama_paket" type="text" placeholder="Judul Paket" required>
                                <p class="text-gray-600 text-xs italic">Masukkan judul paket. Contoh: Paket A, Paket B.</p>
                            </div>
                        </div>

                        <!-- Field: Price -->
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="harga">
                                    Harga Paket*
                                </label>
                                <input value="{{ old('harga', $pilihpaket->harga) }}" name="harga"
                                       class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                       id="harga" type="number" placeholder="Harga Paket" required>
                                <p class="text-gray-600 text-xs italic">Masukkan harga paket dalam angka. Contoh: 100000.</p>
                            </div>

                            <!-- Field: Deskripsi -->
                            <div class="w-full md:w-1/2 px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="deskripsi">
                                    Deskripsi Paket
                                </label>
                                <textarea name="deskripsi"
                                          class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                          id="deskripsi" rows="3" placeholder="Deskripsi Paket">{{ old('deskripsi', $pilihpaket->deskripsi) }}</textarea>
                                <p class="text-gray-600 text-xs italic">Masukkan deskripsi singkat tentang paket ini.</p>
                            </div>
                        </div>

                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="durasi">
                                    Durasi*
                                </label>
                                <input value="{{ old('durasi', $pilihpaket->durasi) }}" name="durasi"
                                       class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                       id="durasi" type="text" placeholder="durasi" required>
                                <p class="text-gray-600 text-xs italic">Masukkan Jumlah  Durasi.</p>
                            </div>
                        </div>

                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="jumlah_jetski">
                                    Jumlah Paket Jetski*
                                </label>
                                <input value="{{ old('jumlah_jetski', $pilihpaket->jumlah_jetski) }}" name="jumlah_jetski"
                                       class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                       id="jumlah_jetski" type="text" placeholder="jumlah_jetski" required>
                                <p class="text-gray-600 text-xs italic">Masukkan Jumlah  Paket Jetski.</p>
                            </div>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <button type="submit"
                                        class="shadow bg-green-500 hover:bg-green-700 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
