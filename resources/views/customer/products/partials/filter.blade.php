<div class="filter-section sticky-top" style="top: 20px;">
    <h5 class="fw-bold mb-4">Filter Produk</h5>
    
    <div class="mb-4">
        <label class="form-label fw-semibold">Kategori</label>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="category1" checked>
            <label class="form-check-label" for="category1">Sneakers</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="category2">
            <label class="form-check-label" for="category2">Running</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="category3">
            <label class="form-check-label" for="category3">Casual</label>
        </div>
    </div>
    
    <div class="mb-4">
        <label class="form-label fw-semibold">Harga</label>
        <div class="d-flex justify-content-between mb-2">
            <span>Rp 0</span>
            <span>Rp 2.000.000</span>
        </div>
        <input type="range" class="form-range" min="0" max="2000000" step="50000">
    </div>
    
    <div class="mb-4">
        <label class="form-label fw-semibold">Ukuran</label>
        <div class="d-flex flex-wrap gap-2">
            @foreach([38, 39, 40, 41, 42, 43, 44] as $size)
                <button class="btn btn-sm btn-outline-secondary">{{ $size }}</button>
            @endforeach
        </div>
    </div>
    
    <div class="mb-4">
        <label class="form-label fw-semibold">Warna</label>
        <div class="d-flex flex-wrap gap-2">
            <button class="btn btn-sm" style="background-color: #000; width: 30px; height: 30px;"></button>
            <button class="btn btn-sm" style="background-color: #fff; border: 1px solid #ddd; width: 30px; height: 30px;"></button>
            <button class="btn btn-sm" style="background-color: #dc3545; width: 30px; height: 30px;"></button>
            <button class="btn btn-sm" style="background-color: #0d6efd; width: 30px; height: 30px;"></button>
            <button class="btn btn-sm" style="background-color: #198754; width: 30px; height: 30px;"></button>
        </div>
    </div>
    
    <button class="btn btn-primary w-100">Terapkan Filter</button>
    <button class="btn btn-link text-danger w-100 mt-2">Reset Filter</button>
</div>