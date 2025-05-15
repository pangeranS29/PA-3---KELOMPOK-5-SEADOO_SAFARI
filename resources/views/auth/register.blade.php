<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}" id="registerForm">
            @csrf

            <div>
                <x-label for="name" value="{{ __('Nama') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                    autofocus autocomplete="name" />
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required />
                <p id="emailError" class="mt-1 text-sm text-red-600 hidden">Harus menggunakan email Google yang valid (contoh: @gmail.com) yang sudah terdaftar</p>
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-4">
                <x-label for="phone" value="{{ __('No Telepon') }}" />
                <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')"
                    required autocomplete="tel" maxlength="12" />
                <p id="phoneError" class="mt-1 text-sm text-red-600 hidden">Nomor telepon harus berupa angka dan maksimal 12 digit</p>
                @error('phone')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' =>
                                        '<a target="_blank" href="' .
                                        route('terms.show') .
                                        '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                        __('Terms of Service') .
                                        '</a>',
                                    'privacy_policy' =>
                                        '<a target="_blank" href="' .
                                        route('policy.show') .
                                        '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                        __('Privacy Policy') .
                                        '</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('login') }}">
                    {{ __('Sudah Punya Akun?') }}
                </a>

                <x-button class="ms-4" id="submitButton">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const emailInput = document.getElementById('email');
            const emailError = document.getElementById('emailError');
            const phoneInput = document.getElementById('phone');
            const phoneError = document.getElementById('phoneError');
            const registerForm = document.getElementById('registerForm');
            const submitButton = document.getElementById('submitButton');

            // Fungsi untuk memvalidasi email Google
            function validateGoogleEmail(email) {
                const googleDomains = ['gmail.com', 'googlemail.com'];
                const domain = email.split('@')[1];
                return googleDomains.includes(domain);
            }

            // Fungsi untuk memvalidasi nomor telepon
            function validatePhoneNumber(phone) {
                // Hanya angka dan maksimal 12 digit
                return /^\d{1,12}$/.test(phone);
            }

            // Validasi saat input email berubah
            emailInput.addEventListener('input', function() {
                const email = this.value.trim();

                if (email === '') {
                    emailError.classList.add('hidden');
                    return;
                }

                if (!validateGoogleEmail(email)) {
                    emailError.classList.remove('hidden');
                } else {
                    emailError.classList.add('hidden');
                }
            });

            // Validasi saat input telepon berubah
            phoneInput.addEventListener('input', function() {
                // Hanya memperbolehkan input angka
                this.value = this.value.replace(/\D/g, '');

                const phone = this.value.trim();

                if (phone === '') {
                    phoneError.classList.add('hidden');
                    return;
                }

                if (!validatePhoneNumber(phone)) {
                    phoneError.classList.remove('hidden');
                } else {
                    phoneError.classList.add('hidden');
                }
            });

            // Validasi saat form disubmit
            registerForm.addEventListener('submit', function(e) {
                const email = emailInput.value.trim();
                const phone = phoneInput.value.trim();
                let hasError = false;

                if (!validateGoogleEmail(email)) {
                    e.preventDefault();
                    emailError.classList.remove('hidden');
                    emailInput.focus();
                    hasError = true;

                    // Animasi shake untuk menunjukkan error
                    emailInput.classList.add('animate-shake');
                    setTimeout(() => {
                        emailInput.classList.remove('animate-shake');
                    }, 500);
                }

                if (!validatePhoneNumber(phone)) {
                    e.preventDefault();
                    phoneError.classList.remove('hidden');

                    if (!hasError) {
                        phoneInput.focus();
                        hasError = true;
                    }

                    // Animasi shake untuk menunjukkan error
                    phoneInput.classList.add('animate-shake');
                    setTimeout(() => {
                        phoneInput.classList.remove('animate-shake');
                    }, 500);
                }
            });

            // Validasi real-time saat kehilangan fokus
            emailInput.addEventListener('blur', function() {
                const email = this.value.trim();

                if (email === '') {
                    emailError.classList.add('hidden');
                    return;
                }

                if (!validateGoogleEmail(email)) {
                    emailError.classList.remove('hidden');
                } else {
                    emailError.classList.add('hidden');
                }
            });

            phoneInput.addEventListener('blur', function() {
                const phone = this.value.trim();

                if (phone === '') {
                    phoneError.classList.add('hidden');
                    return;
                }

                if (!validatePhoneNumber(phone)) {
                    phoneError.classList.remove('hidden');
                } else {
                    phoneError.classList.add('hidden');
                }
            });
        });
    </script>

    <style>
        /* Animasi shake untuk input error */
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-5px); }
            40%, 80% { transform: translateX(5px); }
        }
        .animate-shake {
            animation: shake 0.5s cubic-bezier(.36,.07,.19,.97) both;
            border-color: #f87171; /* Warna merah untuk border */
        }
    </style>
</x-guest-layout>
