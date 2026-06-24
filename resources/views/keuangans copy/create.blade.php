<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Keuangan') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('keuangans.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Tanggal</label>
                        <input type="date" name="tanggal" value="{{ old('tanggal') }}"
                            class="w-full border rounded px-3 py-2">
                        @error('tanggal')
                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Nama</label>
                        <input type="text" name="nama" value="{{ old('nama') }}"
                            class="w-full border rounded px-3 py-2">
                        @error('nama')
                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Kas</label>
                        <input type="number" name="kas" value="{{ old('kas') }}"
                            class="w-full border rounded px-3 py-2">
                        @error('kas')
                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                
                    <div class="mb-4">
                        <label class="block font-medium mb-1">Modal</label>
                        <input type="number" name="modal" value="{{ old('modal') }}"
                            class="w-full border rounded px-3 py-2">
                        @error('modal')
                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Total</label>
                        <input type="number" name="total" value="{{ old('total') }}"
                            class="w-full border rounded px-3 py-2">
                        @error('total')
                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="flex gap-2">
                        <button type="submit" 
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                            Simpan
                        </button>

                        <a href="{{ route('keuangans.index') }}"
                            class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 transition">
                            Kembali
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>