<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Menampilkan semua data pelanggan.
     */
    public function index()
    {
        // Mengambil semua data dari tabel pelanggans
        $pelanggan = Pelanggan::all();
        
        // Mengembalikan data dalam bentuk JSON (cocok untuk API / testing awal)
        return response()->json($pelanggan);
    }

    /**
     * Menyimpan data pelanggan baru ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi input data
        $request->validate([
            'nama_pelanggan' => 'nullable|string|max:255', // boleh kosong jika bukan custom
            'tgl_pesanan' => 'required|date',             // wajib diisi tanggal
        ]);

        // 2. Simpan ke database
        $pelanggan = Pelanggan::create([
            'nama_pelanggan' => $request->nama_pelanggan,
            'tgl_pesanan' => $request->tgl_pesanan,
        ]);

        // 3. Beri respon sukses
        return response()->json([
            'message' => 'Data pelanggan berhasil disimpan!',
            'data' => $pelanggan
        ], 201);
    }
}