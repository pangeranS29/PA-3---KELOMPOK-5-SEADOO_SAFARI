<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Berita') }}
        </h2>
    </x-slot>

    <div class="py-8 px-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('admin.beritas.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="judul" class="block text-sm font-medium text-gray-700">Judul Berita</label>
                            <input type="text" name="judul" id="judul" value="{{ old('judul', $berita->judul) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                            @error('judul')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="ringkasan" class="block text-sm font-medium text-gray-700">Ringkasan</label>
                            <textarea name="ringkasan" id="ringkasan" rows="3"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">{{ old('ringkasan', $berita->ringkasan) }}</textarea>
                            @error('ringkasan')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="konten" class="block text-sm font-medium text-gray-700">Konten Lengkap</label>
                            <textarea name="konten" id="konten" rows="10"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">{{ old('konten', $berita->konten) }}</textarea>
                            @error('konten')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="gambar" class="block text-sm font-medium text-gray-700">Gambar</label>
                            @if($berita->gambar)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar Berita" class="h-40 rounded">
                                    <p class="text-sm text-gray-500 mt-1">Gambar saat ini</p>
                                </div>
                            @endif
                            <input type="file" name="gambar" id="gambar"
                                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            @error('gambar')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="tautan_eksternal" class="block text-sm font-medium text-gray-700">Tautan Eksternal (Opsional)</label>
                            <input type="url" name="tautan_eksternal" id="tautan_eksternal" value="{{ old('tautan_eksternal', $berita->tautan_eksternal) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                            @error('tautan_eksternal')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="flex items-center">
                                <input type="checkbox" name="dipublikasikan" id="dipublikasikan" value="1"
                                    {{ old('dipublikasikan', $berita->dipublikasikan) ? 'checked' : '' }}
                                    class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <label for="dipublikasikan" class="ml-2 block text-sm text-gray-700">Publikasikan</label>
                            </div>
                            @error('dipublikasikan')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="tanggal_publikasi" class="block text-sm font-medium text-gray-700">Tanggal Publikasi (Opsional)</label>
                            <input type="datetime-local" name="tanggal_publikasi" id="tanggal_publikasi"
                                value="{{ old('tanggal_publikasi', $berita->tanggal_publikasi ? $berita->tanggal_publikasi->format('Y-m-d\TH:i') : '') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                            @error('tanggal_publikasi')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end space-x-2">
                            <a href="{{ route('admin.beritas.index') }}"
                                class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-200 disabled:opacity-25 transition">
                                Batal
                            </a>
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 disabled:opacity-25 transition">
                                Update Berita
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Initialize any JS plugins here if needed
        </script>
    @endpush
</x-app-layout>
