<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Keuangan; // <-- Ini penting agar seeder mengenali model Keuangan

class KeuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Logika untuk membuat 5 data dummy
        for ($i = 1; $i <= 5; $i++) {
            Keuangan::create([
                'tanggal' => now(),
                'nama'    => 'Data Uji ' . $i,
                'kas'     => 100000 * $i,
                'modal'   => 50000 * $i,
                'total'   => 150000 * $i,
            ]);
        }
    }
}