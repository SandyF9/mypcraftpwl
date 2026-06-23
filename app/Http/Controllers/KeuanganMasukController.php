<?php

namespace App\Http\Controllers;

use App\Models\KeuanganKeluarMasuk;
use Illuminate\Http\Request;

class KeuanganKeluarMasukController extends Controller
{
    /**
     * Menampilkan daftar keuangan keluar masuk.
     */
    public function index()
    {
        $keuanganKeluarMasuk = KeuanganKeluarMasuk::latest()->paginate(10);
        
        return view('keuangan-keluar-masuk.index', compact('keuanganKeluarMasuk'));
    }

    /**
     * Menampilkan form untuk membuat data baru.
     */
    public function create()
    {
        return view('keuangan-keluar-masuk.create');
    }

    /**
     * Menyimpan data keuangan baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $this->validateKeuangan($request);

        KeuanganKeluarMasuk::create($validated);

        return redirect()->route('keuangan-keluar-masuk.index')
            ->with('success', 'Data keuangan keluar masuk berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit data.
     */
    public function edit(KeuanganKeluarMasuk $keuanganKeluarMasuk)
    {
        return view('keuangan-keluar-masuk.edit', compact('keuanganKeluarMasuk'));
    }

    /**
     * Memperbarui data keuangan di database.
     */
    public function update(Request $request, KeuanganKeluarMasuk $keuanganKeluarMasuk)
    {
        $validated = $this->validateKeuangan($request);

        $keuanganKeluarMasuk->update($validated);

        return redirect()->route('keuangan-keluar-masuk.index')
            ->with('success', 'Data keuangan keluar masuk berhasil diupdate.');
    }

    /**
     * Menghapus data keuangan dari database.
     */
    public function destroy(KeuanganKeluarMasuk $keuanganKeluarMasuk)
    {
        $keuanganKeluarMasuk->delete();

        return redirect()->route('keuangan-keluar-masuk.index')
            ->with('success', 'Data keuangan keluar masuk berhasil dihapus.');
    }

    /**
     * Validasi terpusat (DRY Principle).
     */
    private function validateKeuangan(Request $request): array
    {
        return $request->validate([
            'tanggal'    => ['required', 'date'],
            'nama'       => ['required', 'string', 'max:100'],
            'kas'        => ['required', 'integer'],
            'modal'      => ['required', 'integer'],      // Ditambahkan
            'total'      => ['required', 'integer'],
            'keterangan' => ['nullable', 'string'],        // Ditambahkan (nullable jika boleh kosong)
        ]);
    }
}