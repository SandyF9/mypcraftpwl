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

        KeuanganMasuk::create($validated);

        return redirect()->route('keuangan-masuks.index')
            ->with('success', 'Data keuangan masuk berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit data.
     */
    public function edit(KeuanganMasuk $keuanganMasuk) 
    {
        return view('keuangan-masuks.edit', compact('keuanganMasuk'));
    }

    /**
     * Memperbarui data keuangan masuk di database.
     */
    public function update(Request $request, KeuanganMasuk $keuanganMasuk)
    {
        $validated = $this->validateKeuangan($request);

        $keuanganMasuk->update($validated);

        return redirect()->route('keuangan-masuks.index')
            ->with('success', 'Data keuangan masuk berhasil diupdate.');
    }

    /**
     * Menghapus data keuangan masuk dari database.
     */
    public function destroy(KeuanganMasuk $keuanganMasuk)
    {
        $keuanganMasuk->delete();

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
            'nama_produk'  => ['required', 'string', 'max:255'],
            'quantity'     => ['required', 'integer', 'min:1'],
            'harga_satuan' => ['required', 'integer', 'min:0'],      
            'jumlah'       => ['required', 'integer'],
            'keterangan'   => ['nullable', 'string'],       
        ]);
    }
}