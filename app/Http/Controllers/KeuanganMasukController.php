<?php

namespace App\Http\Controllers;

use App\Models\KeuanganMasuk; 
use Illuminate\Http\Request;

class KeuanganMasukController extends Controller
{
    /**
     * Menampilkan daftar keuangan masuk.
     */
    public function index()
    {
        // PERBAIKAN: Menggunakan model KeuanganMasuk yang konsisten
        $keuanganMasuks = KeuanganMasuk::latest()->paginate(10);
        
        return view('keuangan-masuks.index', compact('keuanganMasuks'));
    }

    /**
     * Menampilkan form untuk membuat data baru.
     */
    public function create()
    {
        return view('keuangan-masuks.create');
    }

    /**
     * Menyimpan data keuangan masuk baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $this->validateKeuangan($request);

        // PERBAIKAN: Menggunakan model KeuanganMasuk
        KeuanganMasuk::create($validated);

        return redirect()->route('keuangan-masuks.index')
            ->with('success', 'Data keuangan masuk berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit data.
     */
    public function edit(KeuanganMasuk $keuanganMasuks)
    {
        return view('keuangan-masuks.edit', compact('keuanganMasuks'));
    }

    /**
     * Memperbarui data keuangan masuk di database.
     */
    public function update(Request $request, KeuanganMasuk $keuanganMasuks)
    {
        $validated = $this->validateKeuangan($request);

        $keuanganMasuks->update($validated);

        return redirect()->route('keuangan-masuks.index')
            ->with('success', 'Data keuangan masuk berhasil diupdate.');
    }

    /**
     * Menghapus data keuangan masuk dari database.
     */
    public function destroy($keuanganMasuks)
    {
        $keuanganMasuks->delete();

        return redirect()->route('keuangan-masuks.index')
            ->with('success', 'Data keuangan masuk berhasil dihapus.');
    }

    /**
     * Validasi terpusat (DRY Principle).
     */
    private function validateKeuangan(Request $request): array
    {
        return $request->validate([
            'tanggal'      => ['required', 'date'],
            'nama_produk'  => ['required', 'string'],
            'harga_satuan' => ['required', 'integer'],      
            'jumlah'       => ['required', 'integer'],
            'keterangan'   => ['nullable', 'string'], //opsional diubah atau tidak       
        ]);
    }
}