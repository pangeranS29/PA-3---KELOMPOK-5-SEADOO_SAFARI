<x-app-layout>
    <x-slot name="header">
        <center>
            <h2 class="text-2xl font-bold text-gray-800 leading-tight">
                {{ isset($detail_paket) ? __('Edit Detail Paket') : __('Buat Detail Paket') }}
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

                    <form class="w-full" action="{{ isset($detail_paket) ? route('admin.detail_pakets.update', $detail_paket->id) : route('admin.detail_pakets.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @if(isset($detail_paket))
                            @method('PUT')
                        @endif

                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="paket_jetski_id">
                                    Nama Paket*
                                </label>
                                <select name="paket_jetski_id" id="paket_jetski_id"
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    required>
                                    <option value="" data-harga="" data-deskripsi="" data-stok="" data-durasi="">Pilih Paket</option>
                                    @foreach ($pilihpakets as $pilihpaket)
                                        <option value="{{ $pilihpaket->id }}"
                                            data-harga="{{ $pilihpaket->harga }}"
                                            data-deskripsi="{{ $pilihpaket->deskripsi }}"
                                            data-stok="{{ $pilihpaket->jumlah_jetski }}"
                                            data-durasi="{{ $pilihpaket->durasi }}"
                                            {{ (old('paket_jetski_id', isset($detail_paket) ? $detail_paket->paket_jetski_id : '') == $pilihpaket->id) ? 'selected' : '' }}>
                                            {{ $pilihpaket->nama_paket }}
                                        </option>
                                    @endforeach
                                </select>
                                <p class="text-gray-600 text-xs italic">Masukkan judul paket. Contoh: Paket A, Paket B.</p>
                            </div>
                        </div>

                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="harga">
                                    Harga*
                                </label>
                                <input value="{{ old('harga', isset($detail_paket) ? $detail_paket->harga : '') }}" name="harga" id="harga"
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    type="number" placeholder="Harga Paket" required readonly>
                                <p class="text-gray-600 text-xs italic">Masukkan harga paket dalam angka. Contoh: 100000.</p>
                            </div>

                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="deskripsi">
                                    Deskripsi*
                                </label>
                                <textarea name="deskripsi" id="deskripsi"
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    rows="3" placeholder="Deskripsi Paket" required readonly>{{ old('deskripsi', isset($detail_paket) ? $detail_paket->deskripsi : '') }}</textarea>
                                <p class="text-gray-600 text-xs italic">Masukkan deskripsi singkat tentang paket ini.</p>
                            </div>
                        </div>

                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="title">
                                    Jumlah Jetski*
                                </label>
                                <input value="{{ old('jumlah_jetski', isset($detail_paket) ? $detail_paket->jumlah_jetski : '') }}" name="jumlah_jetski"
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="jumlah_jetski" type="number" placeholder="Masukkan Jumlah Jetski" required>
                                <p class="text-gray-600 text-xs italic">Masukkan Stock dalam angka . Contoh: 10, 100. 10000</p>
                            </div>

                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="durasi">
                                    Durasi Paket (Menit)*
                                </label>
                                <input value="{{ old('durasi', isset($detail_paket) ? $detail_paket->durasi : '') }}" name="durasi" id="durasi"
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    type="number" placeholder="Durasi dalam menit" readonly required>
                                <p class="text-gray-600 text-xs italic">Durasi dalam satuan menit. Contoh: 60, 120.</p>
                            </div>
                        </div>

                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="foto">
                                    Foto*
                                </label>

                                @if(isset($detail_paket) && $detail_paket->foto)
                                    <div class="mb-4">
                                        <img src="{{ asset('storage/' . $detail_paket->foto) }}" alt="Foto Paket" class="w-40 h-40 object-cover rounded-md">
                                        <p class="text-gray-600 text-xs italic mt-2">Foto saat ini</p>
                                    </div>
                                @endif

                                <input name="foto"
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    accept="image/png,image/jpeg,image/jpg,image/webp" id="foto" type="file">
                                <p class="text-gray-600 text-xs italic">Upload foto baru untuk mengganti foto yang ada</p>
                            </div>
                        </div>

                        <div class="flex flex-wrap -mx-3 mb-6 ">
                            <div class="w-full px-3 text-right flex justify-between items-center mb-6">
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
                                    {{ isset($detail_paket) ? 'Update Paket' : 'Simpan Paket' }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('paket_jetski_id').addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            const harga = selectedOption.getAttribute('data-harga');
            const deskripsi = selectedOption.getAttribute('data-deskripsi');
            const stok = selectedOption.getAttribute('data-stok');
            const durasi = selectedOption.getAttribute('data-durasi');

            document.getElementById('harga').value = harga;
            document.getElementById('deskripsi').value = deskripsi;
            document.getElementById('jumlah_jetski').value = stok;

            const durasiInput = document.getElementById('durasi');
            if (durasiInput) {
                durasiInput.value = durasi;
            }
        });

        // Inisialisasi nilai jika sedang edit
        @if(isset($detail_paket))
            document.addEventListener('DOMContentLoaded', function() {
                const select = document.getElementById('paket_jetski_id');
                if (select.value) {
                    const event = new Event('change');
                    select.dispatchEvent(event);
                }
            });
        @endif
    </script>
</x-app-layout>
