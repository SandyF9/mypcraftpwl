<?php

namespace App\Http\Controllers;

use App\Models\Transaction; // Pastikan kamu sudah membuat model Transaction
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Menampilkan daftar transaksi dan menghitung ringkasan total.
     */
    public function index()
    {
        // 1. Mengambil data transaksi dengan paginasi agar load halaman tetap ringan
        $transactions = Transaction::latest()->paginate(10);

        // 2. Menghitung Total Uang Masuk (type = 'in') langsung dari database
        $totalMasuk = Transaction::where('type', 'in')->sum('nominal');

        // 3. Menghitung Total Uang Keluar (type = 'out') langsung dari database
        $totalKeluar = Transaction::where('type', 'out')->sum('nominal');

        // 4. Menghitung Sisa Saldo (Total Akhir) otomatis melalui operasi matematika
        $sisaSaldo = $totalMasuk - $totalKeluar;

        // Mengirimkan semua data ke view
        return view('transactions.index', compact(
            'transactions',
            'totalMasuk',
            'totalKeluar',
            'sisaSaldo'
        ));
    }

    /**
     * Menyimpan data transaksi baru (Masuk atau Keluar).
     */
    public function store(Request $request)
    {
        // Validasi ketat untuk menjaga integritas data database
        $validated = $request->validate([
            'tanggal'    => ['required', 'date'],
            'nama'       => ['required', 'string', 'max:100'],
            'type'       => ['required', 'in:in,out'], // Mengunci input agar hanya bisa diisi 'in' atau 'out'
            'nominal'    => ['required', 'integer', 'min:1'],
            'keterangan' => ['nullable', 'string'],
        ]);

        // Menyimpan data ke database
        Transaction::create($validated);

        return redirect()->route('transactions.index')
            ->with('success', 'Transaksi berhasil dicatat!');
    }
}