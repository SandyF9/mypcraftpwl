<?php

namespace App\Http\Controllers;

use App\Models\KeuanganKeluar; 
use Illuminate\Http\Request;

class KeuanganKeluarController extends Controller
{
    /**
     * Menampilkan daftar keuangan keluar.
     */
    public function index()
    {
        $keuanganKeluars = KeuanganKeluar::latest()->paginate(10);
        
        return view('keuangan-keluars.index', compact('keuanganKeluars'));
    }

    /**
     * Menampilkan form untuk membuat data pengeluaran baru.
     */
    public function create()
    {
        return view('keuangan-keluars.create');
    }

    /**
     * Menyimpan data keuangan keluar baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $this->validateKeuangan($request);

        KeuanganKeluar::create($validated);

        return redirect()->route('keuangan-keluars.index')
            ->with('success', 'Data keuangan keluar berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit data pengeluaran.
     */
    public function edit(KeuanganKeluar $keuanganKeluar) // PERBAIKAN: Diubah menjadi tunggal ($keuanganKeluar)
    {
        return view('keuangan-keluars.edit', compact('keuanganKeluar'));
    }

    /**
     * Memperbarui data keuangan keluar di database.
     */
    public function update(Request $request, KeuanganKeluar $keuanganKeluar) // PERBAIKAN: Diubah menjadi tunggal ($keuanganKeluar)
    {
        $validated = $this->validateKeuangan($request);

        $keuanganKeluar->update($validated);

        return redirect()->route('keuangan-keluars.index')
            ->with('success', 'Data keuangan keluar berhasil diupdate.');
    }

    /**
     * Menghapus data keuangan keluar dari database.
     */
    public function destroy(KeuanganKeluar $keuanganKeluar)
    {
        $keuanganKeluar->delete();

        return redirect()->route('keuangan-keluars.index')
            ->with('success', 'Data keuangan keluar berhasil dihapus.');
    }

    /**
     * Validasi terpusat (DRY Principle).
     */
    private function validateKeuangan(Request $request): array
    {
        return $request->validate([
            'tanggal'     => ['required', 'date'],
            'nama'        => ['required', 'string', 'max:255'],
            'quantity'    => ['required', 'integer', 'min:1'],
            'harga_satuan'=> ['required', 'integer', 'min:0'], 
            'jumlah'      => ['required', 'integer'],     
            'keterangan'  => ['nullable', 'string'],       
        ]);
    }
}