@extends('layouts.app')

@section('content')
<div class="bg-gray-200 flex flex-col min-h-screen">
    <!-- Navbar -->
    <nav class="navbar flex items-center bg-black bg-opacity-80 p-4 fixed top-0 w-full z-50">
        <a href="{{ route('home') }}">
            <img src="{{ asset('logo.png') }}" alt="Logo" class="h-12 ml-6">
        </a>
        <div class="ml-auto">
            {{-- <a href="{{ route('login') }}" class="login-btn bg-yellow-500 text-black py-2 px-4 rounded-lg font-bold hover:bg-yellow-600 transition"> --}}
                <i class="fas fa-sign-in-alt"></i> Login
            </a>
        </div>
    </nav>

    <!-- Payment Section -->
    <div class="flex-grow flex justify-center items-center py-12 mt-16">
        <div class="bg-white w-full max-w-md mx-auto rounded-lg shadow-lg overflow-hidden relative">
            <div class="bg-black text-white p-4 flex justify-between items-center">
                <h1 class="text-lg">Seadoo Safari Payment</h1>
                <button class="text-white text-xl" onclick="window.location.href='{{ route('detail.pembayaran') }}'">×</button>
            </div>
            <div class="p-4">
                <div class="flex justify-between items-center mb-4">
                    <div>
                        <p class="text-gray-500">Total</p>
                        <p class="text-2xl font-bold">Rp 900.000</p>
                    </div>
                    <div class="text-right">
                        <p class="text-gray-500 text-sm">Choose within 00:08:58</p>
                        <p class="text-blue-500 text-sm">Details</p>
                    </div>
                </div>
                <div class="text-gray-500 text-sm mb-4">Order ID: JADWAL{{ Str::uuid() }}</div>

                <div class="border-t border-gray-300 pt-4">
                    <p class="text-gray-500 mb-2">Virtual Account</p>
                    <div class="space-y-4">
                        @foreach (['BCA', 'Mandiri', 'BNI', 'Permata'] as $bank)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input class="mr-2" type="radio" name="virtual-account" value="{{ $bank }}" id="{{ strtolower($bank) }}-va">
                                <p>{{ $bank }} Virtual Account</p>
                            </div>
                            <img src="{{ asset('images/' . strtolower($bank) . '.jpg') }}" alt="{{ $bank }} logo" width="30" height="30">
                        </div>
                        @endforeach
                    </div>
                </div>

                <button id="pay-button" class="w-full bg-yellow-500 text-black font-bold py-2 px-4 rounded-lg mt-4 hover:bg-yellow-600">
                    Bayar Sekarang
                </button>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-black text-white py-10">
        <div class="container mx-auto px-5 text-center">
            <p>© 2025 Seadoo Safari Samosir. All Rights Reserved.</p>
        </div>
    </footer>
</div>

<script>
    document.getElementById('pay-button').addEventListener('click', function() {
        window.location.href = "{{ route('verifikasi') }}";
    });
</script>
@endsection
