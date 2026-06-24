<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Keuangan') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold">Daftar Keuangan</h3>
                    <a href="{{ route('keuangans.create') }}" class="px-4 py-2 bg-blue-600">
                        Tambah Keuangan
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full border border-gray-300">

                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border px-4 py-2 text-left">No</th>
                                <th class="border px-4 py-2 text-left">Tanggal</th>
                                <th class="border px-4 py-2 text-left">Nama</th>
                                <th class="border px-4 py-2 text-left">Kas</th>
                                <th class="border px-4 py-2 text-left">Modal</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($keuangans as $key => $keuangan)
                                <tr>

                                    <td class="border px-4 py-2">
                                        {{ $keuangans->firstItem() + $key }}
                                    </td>

                                    <td class="border px-4 py-2">
                                        {{ $keuangan->tanggal }}
                                    </td>

                                    <td class="border px-4 py-2">
                                        {{ $keuangan->nama }}
                                    </td>

                                    <td class="border px-4 py-2">
                                        {{ $keuangan->kas }}
                                    </td>

                                    <td class="border px-4 py-2">
                                        {{ $keuangan->modal }}
                                    </td>

                                    <td class="border px-4 py-2">

                                        <a href="{{ route('keuangans.edit', $keuangan->id) }}" class="px-3 py-1 bg-yellow-500">
                                            Edit
                                        </a>

                                        <form action="{{ route('keuangans.destroy', $keuangan->id) }}" method="POST"
                                            class="inline-block" onsubmit="return confirm('Yakin hapus keuangan ini?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="px-3 py-1 bg-red-600">
                                                Hapus
                                            </button>

                                        </form>

                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="6" class="border px-4 py-2 text-center">
                                        Belum ada data keuangan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>

                <div class="mt-4">
                    {{ $keuangans->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>