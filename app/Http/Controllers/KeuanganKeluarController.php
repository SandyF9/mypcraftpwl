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
        $keuanganKeluar = KeuanganKeluar::latest()->paginate(10);
        
        return view('keuangan-keluar.index', compact('keuanganKeluar'));
    }

    /**
     * Menampilkan form untuk membuat data baru.
     */
    public function create()
    {
        return view('keuangan-keluar.create');
    }

    /**
     * Menyimpan data keuangan baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $this->validateKeuangan($request);

        KeuanganKeluar::create($validated);

        return redirect()->route('keuangan-keluar.index')
            ->with('success', 'Data keuangan keluar berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit data.
     */
    public function edit(KeuanganKeluar $keuanganKeluar)
    {
        return view('keuangan-keluar.edit', compact('keuanganKeluar'));
    }

    /**
     * Memperbarui data keuangan di database.
     */
    public function update(Request $request, KeuanganKeluar $keuanganKeluar)
    {
        $validated = $this->validateKeuangan($request);

        $keuanganKeluar->update($validated);

        return redirect()->route('keuangan-keluar.index')
            ->with('success', 'Data keuangan keluar berhasil diupdate.');
    }

    /**
     * Menghapus data keuangan dari database.
     */
    public function destroy(KeuanganKeluar $keuanganKeluar)
    {
        $keuanganKeluar->delete();

        return redirect()->route('keuangan-keluar.index')
            ->with('success', 'Data keuangan keluar berhasil dihapus.');
    }

    /**
     * Validasi terpusat (DRY Principle).
     */
    private function validateKeuangan(Request $request): array
    {
        return $request->validate([
            'tanggal' => ['required', 'date'],
            'nama'    => ['required', 'string', 'max:100'],
            'kas'     => ['required', 'integer'],
        ]);
    }
}