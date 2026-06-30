<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk - mypcraft</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        /* Gaya CSS agar judul kolom tabel interaktif saat diarahkan kursor */
        th a {
            text-decoration: none;
            color: #212529;
            display: block;
            width: 100%;
        }
        th a:hover {
            color: #0d6efd;
        }
    </style>
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-white py-3">
            <h5 class="card-title mb-0">📦 Data Perangkat Produk - mypcraft</h5>
        </div>
        <div class="card-body">
            
            <form method="GET" action="{{ route('products.index') }}" class="row mb-3 align-items-center">
                <div class="col-sm-6 d-flex align-items-center">
                    <select name="per_page" class="form-select form-select-sm w-auto me-2" onchange="this.form.submit()">
                        <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                    </select>
                    <span class="text-secondary small">entries per page</span>
                </div>
                <div class="col-sm-6 d-flex justify-content-sm-end mt-2 mt-sm-0">
                    <div class="input-group input-group-sm w-50">
                        <span class="input-group-text bg-white">Search:</span>
                        <input type="text" name="search" class="form-control" value="{{ $search }}" placeholder="Ketik lalu enter...">
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover align-middle" style="width:100%">
                    <thead class="table-light">
                        <tr>
                            <th><a href="{{ request()->fullUrlWithQuery(['sort_by' => 'name', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Name ⇅</a></th>
                            <th><a href="{{ request()->fullUrlWithQuery(['sort_by' => 'category', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Category ⇅</a></th>
                            <th><a href="{{ request()->fullUrlWithQuery(['sort_by' => 'brand', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Brand ⇅</a></th>
                            <th><a href="{{ request()->fullUrlWithQuery(['sort_by' => 'stock', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Stock ⇅</a></th>
                            <th><a href="{{ request()->fullUrlWithQuery(['sort_by' => 'release_date', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Release date ⇅</a></th>
                            <th><a href="{{ request()->fullUrlWithQuery(['sort_by' => 'price', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Price ⇅</a></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                        <tr>
                            <td><strong>{{ $product->name }}</strong></td>
                            <td><span class="badge bg-secondary">{{ $product->category }}</span></td>
                            <td>{{ $product->brand }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>{{ \Carbon\Carbon::parse($product->release_date)->format('Y/m/d') }}</td>
                            <td>${{ number_format($product->price, 0, ',', ',') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">No matching records found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="small text-secondary">
                    Showing {{ $products->firstItem() ?? 0 }} to {{ $products->lastItem() ?? 0 }} of {{ $products->total() }} entries
                </div>
                <div>
                    {{ $products->links('pagination::bootstrap-5') }}
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 