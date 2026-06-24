<?php

namespace App\Http\Controllers;

// Menggunakan model KeuanganKeluar untuk mencatat transaksi pengeluaran
use App\Models\KeuanganKeluar; 
use Illuminate\Http\Request;

class KeuanganKeluarController extends Controller
{
    /**
     * Menampilkan daftar keuangan keluar.
     */
    public function index()
    {
        // Mengambil data dari model KeuanganKeluar dengan pagination (10 data per halaman)
        $keuanganKeluar = KeuanganKeluar::latest()->paginate(10);
        
        return view('keuangan-keluar.index', compact('keuanganKeluar'));
    }

    /**
     * Menampilkan form untuk membuat data pengeluaran baru.
     */
    public function create()
    {
        return view('keuangan-keluar.create');
    }

    /**
     * Menyimpan data keuangan keluar baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $this->validateKeuangan($request);

        // Menyimpan menggunakan model KeuanganKeluar
        KeuanganKeluar::create($validated);

        return redirect()->route('keuangan-keluar.index')
            ->with('success', 'Data keuangan keluar berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit data pengeluaran.
     */
    public function edit(KeuanganKeluar $keuanganKeluar)
    {
        return view('keuangan-keluar.edit', compact('keuanganKeluar'));
    }

    /**
     * Memperbarui data keuangan keluar di database.
     */
    public function update(Request $request, KeuanganKeluar $keuanganKeluar)
    {
        $validated = $this->validateKeuangan($request);

        $keuanganKeluar->update($validated);

        return redirect()->route('keuangan-keluar.index')
            ->with('success', 'Data keuangan keluar berhasil diupdate.');
    }

    /**
     * Menghapus data keuangan keluar dari database.
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
            'tanggal'     => ['required', 'date'],
            'nama'        => ['required', 'string', 'max:100'],
            'quantitas'   => ['required', 'integer'],
            'harga_satuan'=> ['required', 'integer'], 
            'jumlah'      => ['required', 'integer'],     
            'keterangan'  => ['nullable', 'string'],       
        ]);
    }
}