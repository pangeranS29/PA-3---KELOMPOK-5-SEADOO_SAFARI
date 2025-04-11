<x-front-layout>
    <main class="flex justify-center items-center min-h-screen pt-20" style="background-color: #000000;">
        <div class="bg-gray-800 p-8 rounded-lg w-full max-w-md">
            <h1 class="text-center text-white text-2xl mb-6">BOOKING TICKET</h1>

            <form action="{{ route('front.checkout.store', $detail_paket->id) }}" method="POST" id="checkoutForm">
                @csrf

                <!-- Identitas Pemesan -->
                <section class="mb-6">
                    <div class="mb-4">
                        <label class="block mb-2 text-white" for="name">Identitas Pemesan</label>
                        <input class="w-full p-2 rounded bg-gray-700 text-white" id="name" name="name"
                            type="text" required value="{{ Auth::user()->name }}" placeholder="Insert Full Name">
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 text-white" for="phone">No. Telepon</label>
                        <input class="w-full p-2 rounded bg-gray-700 text-white" id="phone" name="phone"
                            type="text" required placeholder="No. Telepon"
                            value="{{ old('phone', Auth::user()->phone) }}">

                    </div>
                </section>

                <!-- Jadwal Kedatangan -->
                <section class="mb-6">
                    <div class="mb-4">
                        <label class="block mb-2 text-white" for="date">Jadwal Kedatangan (Check In)</label>
                        <input class="w-full p-2 rounded bg-gray-700 text-white" id="date" name="date"
                            type="date" required>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 text-white" for="time">Pilih Jam</label>
                        <input class="w-full p-2 rounded bg-gray-700 text-white" id="time" name="time"
                            type="time" required>
                    </div>
                </section>

                <!-- Jadwal Kepulangan -->
                <section class="mb-6">
                    <div class="mb-4">
                        <label class="block mb-2 text-white" for="date-out">Jadwal Kepulangan (Check Out)</label>
                        <input class="w-full p-2 rounded bg-gray-700 text-white" id="date-out" name="date_out"
                            type="date" required readonly>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 text-white" for="time-out">Pilih Jam</label>
                        <input class="w-full p-2 rounded bg-gray-700 text-white" id="time-out" name="time_out"
                            type="time" required readonly>
                    </div>
                </section>

                <!-- Jumlah Penumpang -->
                <section class="mb-6">
                    <div class="mb-4">
                        <label class="block mb-2 text-white" for="passenger">Jumlah Penumpang</label>
                        <input class="w-full p-2 rounded bg-gray-700 text-white" id="passenger" name="jumlah_penumpang"
                            type="number" required min="1" placeholder="Masukkan Jumlah Penumpang">
                    </div>
                </section>

                <!-- Drone Option -->
                <section class="mb-6">
                    <h2 class="text-lg text-white mb-4">Opsi Tambahan</h2>
                    <div class="mb-4 flex items-center">
                        <input class="mr-2" id="harga-drone" type="checkbox" name="harga_drone">
                        <label class="text-white" for="harga-drone">Include dengan Drone</label>
                    </div>
                </section>

                <!-- Modal Drone -->
                <div id="drone-modal"
                    class="fixed inset-0 bg-black bg-opacity-60 hidden items-center justify-center z-50">
                    <div class="bg-gray-800 p-6 rounded-lg w-full max-w-md">
                        <h3 class="text-lg text-white mb-2">SYARAT DAN KETENTUAN DRONE</h3>
                        <p class="text-sm text-white mb-4">
                            Penggunaan drone hanya diperbolehkan di area yang telah ditentukan dan harus mengikuti
                            peraturan keselamatan penerbangan lokal.
                        </p>
                        <p class="text-yellow-400 mb-4">
                            <strong>Biaya Tambahan: Rp
                                {{ number_format($detail_paket->harga_drone, 0, ',', '.') }}</strong>
                        </p>
                        <div class="flex justify-between space-x-4">
                            <button id="cancel-modal" type="button"
                                class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-400">
                                Batal
                            </button>
                            <button id="close-modal" type="button"
                                class="bg-yellow-500 text-black px-4 py-2 rounded hover:bg-yellow-400">
                                Lanjutkan
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Tombol Submit -->
                <section>
                    <button class="bg-yellow-500 text-black w-full py-2 rounded" type="submit">
                        Selesai
                    </button>
                </section>
            </form>
        </div>
    </main>

    <script>
        const checkbox = document.getElementById('harga-drone');
        const modal = document.getElementById('drone-modal');
        const closeModal = document.getElementById('close-modal');
        const cancelModal = document.getElementById('cancel-modal');

        checkbox.addEventListener('change', function() {
            if (this.checked) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }
        });

        closeModal.addEventListener('click', () => {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        });

        cancelModal.addEventListener('click', () => {
            checkbox.checked = false;
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        });

        // Konversi durasi ke milidetik (jika durasi dalam menit)
        const durasiDetik = ({{ $detail_paket->pilihpaket->durasi ?? 0 }}) * 60;

        function updateCheckoutTime() {
            const date = document.getElementById('date').value;
            const time = document.getElementById('time').value;

            if (date && time) {
                const mulai = new Date(`${date}T${time}`);
                const selesai = new Date(mulai.getTime() + durasiDetik * 1000);

                document.getElementById('date-out').value = selesai.toISOString().split('T')[0];
                document.getElementById('time-out').value = selesai.toTimeString().slice(0, 5);
            }
        }

        document.getElementById('date').addEventListener('change', updateCheckoutTime);
        document.getElementById('time').addEventListener('change', updateCheckoutTime);

        document.getElementById('checkoutForm').addEventListener('submit', function(e) {
            const date = document.getElementById('date').value;
            const time = document.getElementById('time').value;
            const dateOut = document.getElementById('date-out').value;
            const timeOut = document.getElementById('time-out').value;

            if (!date || !time || !dateOut || !timeOut) {
                e.preventDefault();
                alert('Silakan lengkapi tanggal dan jam check-in dan check-out.');
                return;
            }

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
    </script>
</x-front-layout>
