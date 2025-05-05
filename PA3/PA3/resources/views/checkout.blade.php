<x-front-layout>
    <main class="min-h-screen bg-gradient-to-b from-gray-900 to-gray-800 pt-20 pb-10">
        <div class="container mx-auto px-4">
            <div class="max-w-5xl mx-auto flex flex-col lg:flex-row gap-8">
                <!-- Kolom Kiri - Ringkasan Paket -->
                <div class="lg:w-1/3">
                    <div class="bg-gray-800 rounded-xl shadow-2xl overflow-hidden sticky top-28">
                        <div class="relative">
                            <img src="{{ $detail_paket->thumbnail }}" alt="{{ $detail_paket->pilihpaket->nama_paket }}"
                                class="w-full h-48 object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                            <div class="absolute bottom-4 left-4">
                                <h2 class="text-white text-xl font-bold">{{ $detail_paket->pilihpaket->nama_paket }}
                                </h2>
                            </div>
                        </div>

                        <div class="p-6">
                            <div class="flex justify-between items-center mb-4">
                                <span class="text-gray-300">Durasi</span>
                                <span class="text-white font-medium">{{ $detail_paket->pilihpaket->durasi }}
                                    Menit</span>
                            </div>

                            <div class="flex justify-between items-center mb-4">
                                <span class="text-gray-300">Harga Dasar</span>
                                <span class="text-white font-medium">Rp
                                    {{ number_format($detail_paket->pilihpaket->harga, 0, ',', '.') }}</span>
                            </div>

                            <div class="flex justify-between items-center mb-6">
                                <span class="text-gray-300">Opsi Drone</span>
                                <span class="text-white font-medium" id="drone-price-display">
                                    + Rp 0
                                </span>
                            </div>

                            <div class="border-t border-gray-700 pt-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-300 font-medium">Total Harga:</span>
                                    <span class="text-yellow-400 text-xl font-bold" id="total-estimate">Rp
                                        {{ number_format($detail_paket->pilihpaket->harga, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan - Form Pemesanan -->
                <div class="lg:w-2/3">
                    <div class="bg-gray-800 rounded-xl shadow-2xl overflow-hidden">
                        <div class="bg-gradient-to-r from-yellow-500 to-yellow-400 p-4">
                            <h1 class="text-black text-2xl font-bold">DETAIL PEMESANAN</h1>
                        </div>

                        <form action="{{ route('front.checkout.store', $detail_paket->id) }}" method="POST"
                            id="checkoutForm" class="p-6">
                            @csrf

                            <!-- Bagian 1: Informasi Pribadi -->
                            <section class="mb-8">
                                <h2 class="text-white text-lg font-semibold mb-4 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Informasi Pribadi
                                </h2>

                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-gray-300 text-sm mb-1" for="name">Nama
                                            Lengkap</label>
                                        <input
                                            class="w-full p-3 rounded-lg bg-gray-700 text-white border border-gray-600 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-500/50 transition"
                                            id="name" name="name" type="text" required
                                            value="{{ Auth::user()->name }}" placeholder="Nama lengkap Anda">
                                    </div>

                                    <div>
                                        <label class="block text-gray-300 text-sm mb-1" for="phone">Nomor
                                            Telepon</label>
                                        <input
                                            class="w-full p-3 rounded-lg bg-gray-700 text-white border border-gray-600 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-500/50 transition"
                                            id="phone" name="phone" type="text" required
                                            placeholder="Nomor telepon Anda"
                                            value="{{ old('phone', Auth::user()->phone) }}">
                                    </div>
                                </div>
                            </section>

                            <!-- Bagian 2: Jadwal -->
                            <section class="mb-8">
                                <h2 class="text-white text-lg font-semibold mb-4 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Detail Jadwal
                                </h2>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-gray-300 text-sm mb-1" for="date">Tanggal
                                            Check-In</label>
                                        <div class="relative">
                                            <input
                                                class="w-full p-3 rounded-lg bg-gray-700 text-white border border-gray-600 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-500/50 transition cursor-pointer"
                                                id="date" name="date" type="date" required>
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block text-gray-300 text-sm mb-1" for="time">Waktu
                                            Check-In</label>
                                        <div class="relative">
                                            <input
                                                class="w-full p-3 rounded-lg bg-gray-700 text-white border border-gray-600 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-500/50 transition cursor-pointer"
                                                id="time" name="time" type="time" required>
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block text-gray-300 text-sm mb-1" for="date-out">Tanggal
                                            Check-Out</label>
                                        <div class="relative">
                                            <input
                                                class="w-full p-3 rounded-lg bg-gray-700 text-white border border-gray-600 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-500/50 transition"
                                                id="date-out" name="date_out" type="date" required readonly>
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block text-gray-300 text-sm mb-1" for="time-out">Waktu
                                            Check-Out</label>
                                        <div class="relative">
                                            <input
                                                class="w-full p-3 rounded-lg bg-gray-700 text-white border border-gray-600 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-500/50 transition"
                                                id="time-out" name="time_out" type="time" required readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4 bg-gray-700/50 rounded-lg p-4 border border-gray-600">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400 mr-2"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span class="text-yellow-400 text-sm">Durasi:
                                            {{ $detail_paket->pilihpaket->durasi }} Menit</span>
                                    </div>
                                </div>
                            </section>

                            <!-- Bagian 3: Penumpang -->
                            <section class="mb-8">
                                <h2 class="text-white text-lg font-semibold mb-4 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path
                                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v1h8v-1zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-1a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v1h-3zM4.75 12.094A5.973 5.973 0 004 15v1H1v-1a3 3 0 013.75-2.906z" />
                                    </svg>
                                    Detail Penumpang
                                </h2>

                                <div>
                                    <label class="block text-gray-300 text-sm mb-1" for="passenger">Jumlah Penumpang
                                        (Maksimal 2)</label>
                                    <select
                                        class="w-full p-3 rounded-lg bg-gray-700 text-white border border-gray-600 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-500/50 transition"
                                        id="passenger" name="jumlah_penumpang" required
                                        onchange="generatePassengerFields()">
                                        <option value="" disabled selected>Pilih jumlah penumpang</option>
                                        <option value="1">1 Penumpang</option>
                                        <option value="2">2 Penumpang</option>
                                    </select>
                                </div>

                                <div id="passenger-names" class="mt-4 space-y-4"></div>
                            </section>

                            <!-- Bagian 4: Tambahan -->
                            <section class="mb-8">
                                <h2 class="text-white text-lg font-semibold mb-4 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Opsi Tambahan
                                </h2>

                                <!-- Di dalam form checkout -->
                                <div class="space-y-4">
                                    <!-- Opsi Default (Tidak Pakai Drone) -->
                                    <div class="bg-gray-700/50 rounded-lg p-4 border border-gray-600">
                                        <label class="flex items-start cursor-pointer">
                                            <div class="flex items-center h-5">
                                                <input type="radio" id="drone-none" name="drone_option"
                                                    value="0"
                                                    class="h-4 w-4 text-yellow-500 focus:ring-yellow-500 border-gray-600"
                                                    checked>
                                            </div>
                                            <div class="ml-3">
                                                <h3 class="text-white font-medium">Tidak Pakai Drone</h3>
                                                <p class="text-gray-400 text-sm">Tidak menggunakan layanan fotografi
                                                    drone</p>
                                            </div>
                                        </label>
                                    </div>

                                    <!-- Opsi Drone 1 -->
                                    <div class="bg-gray-700/50 rounded-lg p-4 border border-gray-600">
                                        <label class="flex items-start cursor-pointer">
                                            <div class="flex items-center h-5">
                                                <input type="radio" id="drone-option-1" name="drone_option"
                                                    value="500000"
                                                    class="h-4 w-4 text-yellow-500 focus:ring-yellow-500 border-gray-600">
                                            </div>
                                            <div class="ml-3">
                                                <h3 class="text-white font-medium">Fotografi Drone (File Mentah)</h3>
                                                <p class="text-gray-400 text-sm">Foto udara dari pengalaman Anda dengan
                                                    file mentah (+Rp 500.000)</p>
                                            </div>
                                        </label>
                                    </div>

                                    <!-- Opsi Drone 2 -->
                                    <div class="bg-gray-700/50 rounded-lg p-4 border border-gray-600">
                                        <label class="flex items-start cursor-pointer">
                                            <div class="flex items-center h-5">
                                                <input type="radio" id="drone-option-2" name="drone_option"
                                                    value="1000000"
                                                    class="h-4 w-4 text-yellow-500 focus:ring-yellow-500 border-gray-600">
                                            </div>
                                            <div class="ml-3">
                                                <h3 class="text-white font-medium">Fotografi Drone (File + Editing)
                                                </h3>
                                                <p class="text-gray-400 text-sm">Foto udara dengan hasil editing
                                                    profesional (+Rp 1.000.000)</p>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </section>

                            <!-- Tombol Submit -->
                            <div class="mt-8">
                                <button
                                    class="w-full bg-gradient-to-r from-yellow-500 to-yellow-400 hover:from-yellow-400 hover:to-yellow-300 text-black font-bold py-3 px-4 rounded-lg shadow-lg transition-all transform hover:scale-[1.01] flex items-center justify-center"
                                    type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Lanjut ke Pembayaran
                                </button>
                                <input type="hidden" id="harga-drone" name="harga_drone" value="0">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Pindahkan fungsi updateTotal() ke luar DOMContentLoaded agar bisa diakses global
        function updateTotal() {
            const basePrice = {{ $detail_paket->pilihpaket->harga }};
            const droneOption = document.querySelector('input[name="drone_option"]:checked');
            const dronePrice = droneOption ? parseInt(droneOption.value) : 0;
            const total = basePrice + dronePrice;

            // Format angka dengan titik sebagai pemisah ribuan
            const formatRupiah = (number) => {
                return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            };

            // Update total price display
            document.getElementById('total-estimate').textContent = 'Rp ' + formatRupiah(total);

            // Update drone price display
            const dronePriceDisplay = document.getElementById('drone-price-display');
            if (dronePrice > 0) {
                dronePriceDisplay.textContent = '+ Rp ' + formatRupiah(dronePrice);
            } else {
                dronePriceDisplay.textContent = '+ Rp 0';
            }

            // Update hidden field for drone price
            document.getElementById('harga-drone').value = dronePrice;
        }

        // Tambahkan event listener untuk semua radio button drone
        document.querySelectorAll('input[name="drone_option"]').forEach(radio => {
            radio.addEventListener('change', updateTotal);
        });

        // Panggil saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            updateTotal();
        });

        // Tambahkan event listener untuk semua radio button drone
        document.querySelectorAll('input[name="drone_option"]').forEach(radio => {
            radio.addEventListener('change', updateTotal);
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Panggil updateTotal saat halaman dimuat
            updateTotal();

            // Tambahkan event listener untuk radio button drone
            document.querySelectorAll('input[name="drone_option"]').forEach(radio => {
                radio.addEventListener('change', updateTotal);
            });

            // Hitung durasi dan set waktu check-out
            const durasiMenit = {{ $detail_paket->pilihpaket->durasi ?? 0 }};

            function updateCheckoutTime() {
                const date = document.getElementById('date').value;
                const time = document.getElementById('time').value;

                if (date && time) {
                    const mulai = new Date(`${date}T${time}`);
                    const selesai = new Date(mulai.getTime() + durasiMenit * 60 *
                        1000); // Konversi menit ke milidetik

                    document.getElementById('date-out').value = selesai.toISOString().split('T')[0];
                    document.getElementById('time-out').value = selesai.toTimeString().slice(0, 5);
                }
            }

            // Aktifkan date picker saat field diklik
            document.getElementById('date').addEventListener('click', function() {
                this.showPicker();
            });

            // Aktifkan time picker saat field diklik
            document.getElementById('time').addEventListener('click', function() {
                this.showPicker();
            });

            // Update waktu check-out saat date/time berubah
            document.getElementById('date').addEventListener('change', updateCheckoutTime);
            document.getElementById('time').addEventListener('change', updateCheckoutTime);

            // Set tanggal minimal hari ini
            const today = new Date();
            const dd = String(today.getDate()).padStart(2, '0');
            const mm = String(today.getMonth() + 1).padStart(2, '0');
            const yyyy = today.getFullYear();
            const minDate = yyyy + '-' + mm + '-' + dd;

            document.getElementById('date').min = minDate;

            // Generate field nama penumpang
            window.generatePassengerFields = function() {
                const maxPassengers = 2;
                const count = parseInt(document.getElementById('passenger').value) || 0;
                const container = document.getElementById('passenger-names');
                container.innerHTML = '';

                if (count > maxPassengers) {
                    tampilkanPeringatan(`Maksimal ${maxPassengers} penumpang yang diizinkan.`);
                    document.getElementById('passenger').value = maxPassengers;
                    return generatePassengerFields();
                }

                for (let i = 1; i <= count; i++) {
                    const div = document.createElement('div');
                    div.classList.add('bg-gray-700/50', 'rounded-lg', 'p-4', 'border', 'border-gray-600');

                    const label = document.createElement('label');
                    label.classList.add('block', 'text-gray-300', 'text-sm', 'mb-2');
                    label.innerText = `Nama Penumpang ${i}`;

                    const input = document.createElement('input');
                    input.classList.add('w-full', 'p-3', 'rounded-lg', 'bg-gray-700', 'text-white', 'border',
                        'border-gray-600', 'focus:border-yellow-500', 'focus:ring-2',
                        'focus:ring-yellow-500/50', 'transition');
                    input.setAttribute('type', 'text');
                    input.setAttribute('name', `penumpang_${i}_nama`);
                    input.setAttribute('placeholder', `Masukkan nama penumpang ${i}`);

                    div.appendChild(label);
                    div.appendChild(input);
                    container.appendChild(div);
                }
            }

            // Validasi form
            document.getElementById('checkoutForm').addEventListener('submit', function(e) {
                const date = document.getElementById('date').value;
                const time = document.getElementById('time').value;
                const dateOut = document.getElementById('date-out').value;
                const timeOut = document.getElementById('time-out').value;

                if (!date || !time || !dateOut || !timeOut) {
                    e.preventDefault();
                    tampilkanPeringatan('Harap lengkapi semua field jadwal sebelum melanjutkan.');
                    return;
                }

                const passengerCount = parseInt(document.getElementById('passenger').value) || 0;
                if (passengerCount < 1) {
                    e.preventDefault();
                    tampilkanPeringatan('Harap pilih minimal 1 penumpang.');
                    return;
                }

                // Simpan waktu mulai dan selesai sebagai hidden input
                const waktuMulai = `${date}T${time}:00`;
                const waktuSelesai = `${dateOut}T${timeOut}:00`;

                const inputMulai = document.createElement('input');
                inputMulai.type = 'hidden';
                inputMulai.name = 'waktu_mulai';
                inputMulai.value = waktuMulai;

                const inputSelesai = document.createElement('input');
                inputSelesai.type = 'hidden';
                inputSelesai.name = 'waktu_selesai';
                inputSelesai.value = waktuSelesai;

                this.appendChild(inputMulai);
                this.appendChild(inputSelesai);
            });

            function tampilkanPeringatan(pesan) {
                const alert = document.createElement('div');
                alert.classList.add('fixed', 'top-4', 'right-4', 'bg-red-600', 'text-white', 'px-4', 'py-3',
                    'rounded-lg', 'shadow-lg', 'z-50', 'animate-fadeIn', 'transform', 'transition',
                    'duration-300');
                alert.innerHTML = `
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>${pesan}</span>
                    </div>
                `;

                document.body.appendChild(alert);

                setTimeout(() => {
                    alert.classList.add('opacity-0');
                    setTimeout(() => {
                        alert.remove();
                    }, 300);
                }, 3000);
            }


        });
    </script>

    <style>
        .animate-fadeIn {
            animation: fadeIn 0.3s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        input[type="checkbox"]:checked~.dot {
            transform: translateX(100%);
            background-color: #f59e0b;
        }

        input[type="checkbox"]:checked~.block {
            background-color: #f59e0b;
        }
    </style>
</x-front-layout>
