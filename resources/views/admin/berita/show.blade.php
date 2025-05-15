<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Berita') }}
        </h2>
    </x-slot>

    <div class="py-8 px-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-6">
                        <h1 class="text-2xl font-bold text-gray-900">{{ $berita->judul }}</h1>
                        <div class="flex items-center mt-2 text-sm text-gray-500">
                            <span class="mr-3">Status:
                                @if($berita->dipublikasikan)
                                    <span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-200 rounded-full">Published</span>
                                @else
                                    <span class="px-2 py-1 text-xs font-semibold text-red-800 bg-red-200 rounded-full">Draft</span>
                                @endif
                            </span>
                            @if($berita->tanggal_publikasi)
                                <span>| Dipublikasikan pada: {{ $berita->tanggal_publikasi->format('d M Y H:i') }}</span>
                            @endif
                        </div>
                    </div>

                    @if($berita->gambar)
                        <div class="mb-6">
                            <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar Berita" class="rounded-lg w-full max-w-2xl mx-auto">
                        </div>
                    @endif

                    <div class="mb-6">
                        <h2 class="text-lg font-semibold text-gray-900">Ringkasan</h2>
                        <p class="mt-2 text-gray-700">{{ $berita->ringkasan }}</p>
                    </div>

                    <div class="mb-6">
                        <h2 class="text-lg font-semibold text-gray-900">Konten Lengkap</h2>
                        <div class="mt-2 text-gray-700 prose max-w-none">
                            {!! nl2br(e($berita->konten)) !!}
                        </div>
                    </div>

                    @if($berita->tautan_eksternal)
                        <div class="mb-6">
                            <h2 class="text-lg font-semibold text-gray-900">Tautan Eksternal</h2>
                            <a href="{{ $berita->tautan_eksternal }}" target="_blank" class="mt-2 text-blue-600 hover:underline">
                                {{ $berita->tautan_eksternal }}
                            </a>
                        </div>
                    @endif

                    <div class="flex justify-end">
                        <a href="{{ route('admin.beritas.edit', $berita->id) }}"
                            class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 disabled:opacity-25 transition">
                            Edit Berita
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
