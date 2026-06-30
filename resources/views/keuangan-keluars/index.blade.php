<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Daftar Keuangan Keluar') }}
            </h2>
            <a href="{{ route('keuangan-keluars.create') }}" 
                class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition font-medium text-sm">
                Tambah Data
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <div class="p-6 bg-white border-b border-gray-200 overflow-x-auto">
                    
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-100 text-gray-700 uppercase text-sm tracking-wider">
                                <th class="p-3 border-b">No</th>
                                <th class="p-3 border-b">Tanggal</th>
                                <th class="p-3 border-b">Nama</th>
                                <th class="p-3 border-b text-center">Qty</th>
                                <th class="p-3 border-b text-right">Harga Satuan</th>
                                <th class="p-3 border-b text-right">Total Jumlah</th>
                                <th class="p-3 border-b">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm divide-y divide-gray-200">
                            @forelse ($keuanganKeluars as $item)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="p-3 font-medium">{{ $loop->iteration }}</td>
                                    <td class="p-3 whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}
                                    </td>
                                    <td class="p-3 font-semibold text-gray-800">{{ $item->nama }}</td>
                                    <td class="p-3 text-center">{{ $item->quantity }}</td>
                                    <td class="p-3 text-right whitespace-nowrap">Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                                    <td class="p-3 text-right whitespace-nowrap font-bold text-red-600">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                                    <td class="p-3 max-w-xs truncate" title="{{ $item->keterangan }}">
                                        {{ $item->keterangan ?? '-' }}
                                    </td>
                                    <td class="p-3 text-center whitespace-nowrap">
                                        <div class="flex gap-2 justify-center">
                                            <a href="{{ route('keuangan-keluars.edit', $item->id) }}" 
                                                class="px-3 py-1 bg-amber-500 text-white rounded text-xs font-medium hover:bg-amber-600 transition">
                                                Edit
                                            </a>
                                            
                                            <form action="{{ route('keuangan-keluars.destroy', $item->id) }}" method="POST" 
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pengeluaran ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                    class="px-3 py-1 bg-red-600 text-white rounded text-xs font-medium hover:bg-red-700 transition">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="p-8 text-center text-gray-400 italic">
                                        Belum ada data pengeluaran keuangan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    @if(method_exists($keuanganKeluars, 'links'))
                        <div class="mt-4">
                            {{ $keuanganKeluars->links() }}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>