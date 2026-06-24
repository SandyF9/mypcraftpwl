<?php

namespace App\Http\Controllers;

// Pastikan namespace model ini sesuai dengan model yang Anda gunakan untuk keuangan masuk
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
        $keuanganMasuk = KeuanganMasuk::latest()->paginate(10);
        
        return view('keuangan-masuk.index', compact('keuanganMasuk'));
    }

    /**
     * Menampilkan form untuk membuat data baru.
     */
    public function create()
    {
        return view('keuangan-masuk.create');
    }

    /**
     * Menyimpan data keuangan masuk baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $this->validateKeuangan($request);

        // PERBAIKAN: Menggunakan model KeuanganMasuk
        KeuanganMasuk::create($validated);

        return redirect()->route('keuangan-masuk.index')
            ->with('success', 'Data keuangan masuk berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit data.
     */
    public function edit(KeuanganMasuk $keuanganMasuk)
    {
        return view('keuangan-masuk.edit', compact('keuanganMasuk'));
    }

    /**
     * Memperbarui data keuangan masuk di database.
     */
    public function update(Request $request, KeuanganMasuk $keuanganMasuk)
    {
        $validated = $this->validateKeuangan($request);

        $keuanganMasuk->update($validated);

        return redirect()->route('keuangan-masuk.index')
            ->with('success', 'Data keuangan masuk berhasil diupdate.');
    }

    /**
     * Menghapus data keuangan masuk dari database.
     */
    public function destroy($keuanganMasuk)
    {
        $keuanganMasuk->delete();

        return redirect()->route('keuangan-masuk.index')
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