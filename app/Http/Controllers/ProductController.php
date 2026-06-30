<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // 1. Tentukan jumlah data per halaman (default 10 seperti gambar)
        $perPage = $request->input('per_page', 10);
        
        // 2. Ambil kata kunci pencarian jika ada
        $search = $request->input('search');

        // 3. Ambil parameter pengurutan (default berdasarkan nama)
        $sortBy = $request->input('sort_by', 'name');
        $sortOrder = $request->input('sort_order', 'asc');

        // 4. Query dasar ke database
        $query = Product::query();

        // 5. Logika Pencarian global (mencari ke semua kolom produk)
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('category', 'LIKE', "%{$search}%")
                  ->orWhere('brand', 'LIKE', "%{$search}%")
                  ->orWhere('stock', 'LIKE', "%{$search}%")
                  ->orWhere('price', 'LIKE', "%{$search}%");
            });
        }

        // 6. Logika Pengurutan Kolom
        $query->orderBy($sortBy, $sortOrder);

        // 7. Ambil data dengan Pagination bawaan Laravel
        $products = $query->paginate($perPage)->withQueryString();

        // 8. Kirim data ke View
        return view('products.index', compact('products', 'search', 'perPage', 'sortBy', 'sortOrder'));
    }
}