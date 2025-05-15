<x-guest-layout>
    <div
        class="w-full max-w-md bg-gray-900 bg-opacity-80 backdrop-blur-sm rounded-xl p-8 border border-gray-800 shadow-2xl">
        <div class="text-center mb-2">
            <i class="fas fa-user-circle text-5xl text-yellow-500 mb-4"></i>
        </div>

        <h2 class="text-3xl font-bold text-center mb-8 text-yellow-400">Login</h2>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-500">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Tambahkan input hidden untuk redirect_to -->
            <input type="hidden" name="redirect_to" value="{{ request('redirect_to') }}">

            <!-- Email -->
            <div class="mb-5">
                <label for="email" class="block text-gray-400 mb-2">Email</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-envelope text-gray-500"></i>
                    </span>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                        class="w-full pl-10 p-3 bg-gray-800 text-white rounded-lg border border-gray-700 focus:outline-none focus:border-yellow-500 transition duration-300 @error('email') border-red-500 @enderror">
                </div>
                @error('email')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-6">
                <label for="password" class="block text-gray-400 mb-2">Kata Sandi</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-lock text-gray-500"></i>
                    </span>
                    <input id="password" name="password" type="password" required
                        class="w-full pl-10 p-3 bg-gray-800 text-white rounded-lg border border-gray-700 focus:outline-none focus:border-yellow-500 transition duration-300 @error('password') border-red-500 @enderror">
                </div>
                @error('password')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between mb-6">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-700 bg-gray-800 text-yellow-500 shadow-sm focus:ring-yellow-500"
                        name="remember">
                    <span class="ml-2 text-sm text-gray-400">Ingat saya</span>
                </label>
                @if (Route::has('password.request'))
                    <a class="text-sm text-yellow-500 hover:text-yellow-400 hover:underline"
                        href="{{ route('password.request') }}">
                        Lupa Kata Sandi?
                    </a>
                @endif
            </div>

            <button type="submit"
                class="w-full p-3 bg-gradient-to-r from-yellow-500 to-yellow-600 text-black font-bold rounded-lg hover:from-yellow-600 hover:to-yellow-700 transition duration-300 shadow-lg hover:shadow-yellow-500/20">
                Masuk
            </button>
        </form>



        <div class="mt-8 text-center text-gray-400">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-yellow-500 hover:text-yellow-400 hover:underline">Daftar
                Sekarang</a>
        </div>
    </div>
</x-guest-layout>
