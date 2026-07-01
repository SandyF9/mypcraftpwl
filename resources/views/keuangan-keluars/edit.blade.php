<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Keuangan Keluar') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('keuangan-keluars.update', $keuanganKeluar->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block font-medium mb-1"> Tanggal </label>
                        <input type="date" name="tanggal" value="{{ old('tanggal', $keuanganKeluar->tanggal) }}"
                            class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none">
                        @error('tanggal')
                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1"> Nama </label>
                        <input type="text" name="nama" value="{{ old('nama', $keuanganKeluar->nama) }}" placeholder="Contoh: Pembelian Alat Tulis"
                            class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none">
                        @error('nama')
                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block font-medium mb-1"> Quantity </label>
                            <input type="number" name="quantity" id="quantity" value="{{ old('quantity', $keuanganKeluar->quantity) }}" min="1" placeholder="0"
                                class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none">
                            @error('quantity')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label class="block font-medium mb-1"> Harga Satuan (Rp)</label>
                            <input type="number" name="harga_satuan" id="harga_satuan" value="{{ old('harga_satuan', (int)$keuanganKeluar->harga_satuan) }}" min="0" placeholder="0"
                                class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none">
                            @error('harga_satuan')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1"> Jumlah (Rp)</label>
                        <input type="number" name="jumlah" id="jumlah" value="{{ old('jumlah', $keuanganKeluar->jumlah) }}" readonly placeholder="Otomatis terhitung"
                            class="w-full border rounded px-3 py-2 bg-gray-100 cursor-not-allowed text-gray-600 font-semibold focus:outline-none">
                        @error('jumlah')
                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block font-medium mb-1"> Keterangan </label>
                        <textarea name="keterangan" rows="3" placeholder="Tambahkan catatan atau detail pengeluaran..."
                            class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none">{{ old('keterangan', $keuanganKeluar->keterangan) }}</textarea>
                        @error('keterangan')
                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="flex gap-2">
                        <button type="submit" 
                            class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition font-medium">
                            Perbarui Pengeluaran
                        </button>

                        <a href="{{ route('keuangan-keluars.index') }}"
                            class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 transition font-medium">
                            Kembali
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const quantityInput = document.getElementById('quantity');
            const hargaInput = document.getElementById('harga_satuan');
            const jumlahInput = document.getElementById('jumlah');

            function hitungTotal() {
                const qty = parseFloat(quantityInput.value) || 0;
                const harga = parseFloat(hargaInput.value) || 0;
                jumlahInput.value = qty * harga;
            }

            hitungTotal();

            quantityInput.addEventListener('input', hitungTotal);
            hargaInput.addEventListener('input', hitungTotal);
        });
    </script>
</x-app-layout>