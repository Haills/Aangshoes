@extends('layouts.app')

@section('title', 'Detail Produk - Aangshoes')

@section('styles')
<style>
    .product-gallery {
        display: flex;
        flex-direction: column;
    }
    
    .main-image {
        height: 400px;
        object-fit: contain;
        margin-bottom: 10px;
    }
    
    .thumbnail-container {
        display: flex;
        gap: 10px;
    }
    
    .thumbnail {
        width: 70px;
        height: 70px;
        object-fit: cover;
        cursor: pointer;
        border: 2px solid transparent;
    }
    
    .thumbnail.active {
        border-color: var(--primary);
    }
    
    .price {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--primary);
    }
    
    .original-price {
        text-decoration: line-through;
        color: #6c757d;
    }
    
    .discount-badge {
        background: var(--danger);
        color: white;
        padding: 3px 10px;
        border-radius: 4px;
        font-size: 0.9rem;
        font-weight: 500;
    }
    
    .size-option {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #dee2e6;
        cursor: pointer;
        margin-right: 10px;
        margin-bottom: 10px;
    }
    
    .size-option:hover, .size-option.selected {
        border-color: var(--primary);
        background-color: rgba(42, 157, 143, 0.1);
    }
    
    .quantity-input {
        width: 70px;
        text-align: center;
    }
</style>
@endsection

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Produk</a></li>
                <li class="breadcrumb-item active">Detail Produk</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row g-5">
    <!-- Product Images -->
    <div class="col-lg-6">
        <div class="product-gallery">
            <img id="mainImage" src="https://source.unsplash.com/random/800x800/?shoes-1" class="main-image img-fluid rounded" alt="Product Image">
            <div class="thumbnail-container">
                <img src="https://source.unsplash.com/random/300x300/?shoes-1" class="thumbnail active" onclick="changeImage(this)">
                <img src="https://source.unsplash.com/random/300x300/?shoes-2" class="thumbnail" onclick="changeImage(this)">
                <img src="https://source.unsplash.com/random/300x300/?shoes-3" class="thumbnail" onclick="changeImage(this)">
                <img src="https://source.unsplash.com/random/300x300/?shoes-4" class="thumbnail" onclick="changeImage(this)">
            </div>
        </div>
    </div>
    
    <!-- Product Info -->
    <div class="col-lg-6">
        <h2 class="fw-bold mb-3">Sepatu Sneakers A1 Premium Edition</h2>
        
        <div class="d-flex align-items-center mb-3">
            <div class="me-3">
                @for($i = 1; $i <= 5; $i++)
                    @if($i <= 4)
                        <i class="fas fa-star text-warning"></i>
                    @else
                        <i class="far fa-star text-warning"></i>
                    @endif
                @endfor
            </div>
            <span class="text-muted">(42 reviews)</span>
            <span class="ms-3 text-success"><i class="fas fa-check-circle"></i> Tersedia</span>
        </div>
        
        <div class="mb-4">
            @if(true) <!-- Jika ada diskon -->
                <div class="d-flex align-items-center">
                    <span class="price me-3">Rp 720.000</span>
                    <span class="original-price me-3">Rp 900.000</span>
                    <span class="discount-badge">20% OFF</span>
                </div>
            @else
                <span class="price">Rp 900.000</span>
            @endif
        </div>
        
        <p class="mb-4">Sepatu sneakers premium dengan bahan berkualitas tinggi yang nyaman digunakan sehari-hari. Desain modern dengan sol yang tahan lama, cocok untuk berbagai aktivitas.</p>
        
        <div class="mb-4">
            <h6 class="fw-bold mb-3">Ukuran</h6>
            <div class="d-flex flex-wrap">
                @foreach([38, 39, 40, 41, 42, 43, 44] as $size)
                    <div class="size-option {{ $size == 40 ? 'selected' : '' }}" onclick="selectSize(this)">
                        {{ $size }}
                    </div>
                @endforeach
            </div>
        </div>
        
        <div class="mb-4">
            <h6 class="fw-bold mb-3">Warna</h6>
            <div class="d-flex">
                <div class="color-option me-3 selected" style="width: 40px; height: 40px; background-color: #000; border-radius: 50%; cursor: pointer;" onclick="selectColor(this)"></div>
                <div class="color-option me-3" style="width: 40px; height: 40px; background-color: #fff; border: 1px solid #ddd; border-radius: 50%; cursor: pointer;" onclick="selectColor(this)"></div>
                <div class="color-option me-3" style="width: 40px; height: 40px; background-color: #dc3545; border-radius: 50%; cursor: pointer;" onclick="selectColor(this)"></div>
            </div>
        </div>
        
        <div class="d-flex align-items-center mb-4">
            <div class="input-group me-3" style="width: 150px;">
                <button class="btn btn-outline-secondary" type="button" onclick="decreaseQuantity()">-</button>
                <input type="text" class="form-control text-center quantity-input" value="1" id="quantity">
                <button class="btn btn-outline-secondary" type="button" onclick="increaseQuantity()">+</button>
            </div>
            <button class="btn btn-primary flex-grow-1">
                <i class="fas fa-shopping-cart me-2"></i> Tambah ke Keranjang
            </button>
        </div>
        
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex">
                    <div class="me-4">
                        <i class="fas fa-truck text-primary fs-4"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold">Gratis Ongkir</h6>
                        <p class="small mb-0">Gratis ongkir untuk seluruh wilayah Indonesia dengan minimal pembelian Rp 500.000</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Product Details Tabs -->
<div class="row mt-5">
    <div class="col-12">
        <ul class="nav nav-tabs" id="productTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button">Deskripsi</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="specs-tab" data-bs-toggle="tab" data-bs-target="#specs" type="button">Spesifikasi</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button">Ulasan</button>
            </li>
        </ul>
        
        <div class="tab-content p-3 border border-top-0 rounded-bottom" id="productTabsContent">
            <div class="tab-pane fade show active" id="description" role="tabpanel">
                <h5 class="fw-bold mb-3">Deskripsi Produk</h5>
                <p>Sepatu Sneakers A1 Premium Edition adalah sepatu dengan desain modern yang cocok untuk berbagai kesempatan. Dibuat dengan bahan berkualitas tinggi yang nyaman digunakan seharian.</p>
                <p><strong>Keunggulan Produk:</strong></p>
                <ul>
                    <li>Bahan kulit sintetis berkualitas tinggi</li>
                    <li>Sol karet yang tahan lama dan fleksibel</li>
                    <li>Desain ergonomis untuk kenyamanan maksimal</li>
                    <li>Tersedia dalam berbagai ukuran dan warna</li>
                    <li>Garansi 6 bulan untuk kerusakan material</li>
                </ul>
            </div>
            
            <div class="tab-pane fade" id="specs" role="tabpanel">
                <h5 class="fw-bold mb-3">Spesifikasi Teknis</h5>
                <table class="table">
                    <tbody>
                        <tr>
                            <th width="30%">Merek</th>
                            <td>Aangshoes</td>
                        </tr>
                        <tr>
                            <th>Model</th>
                            <td>Sneakers A1</td>
                        </tr>
                        <tr>
                            <th>Bahan</th>
                            <td>Kulit Sintetis</td>
                        </tr>
                        <tr>
                            <th>Warna</th>
                            <td>Hitam, Putih, Merah</td>
                        </tr>
                        <tr>
                            <th>Ukuran</th>
                            <td>38 - 44</td>
                        </tr>
                        <tr>
                            <th>Berat</th>
                            <td>500 gram</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div class="tab-pane fade" id="reviews" role="tabpanel">
                <h5 class="fw-bold mb-3">Ulasan Pelanggan</h5>
                <div class="mb-4">
                    <div class="d-flex align-items-center mb-2">
                        <div class="me-3">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= 4)
                                    <i class="fas fa-star text-warning"></i>
                                @else
                                    <i class="far fa-star text-warning"></i>
                                @endif
                            @endfor
                        </div>
                        <span class="fw-bold">4.2 dari 5 (42 ulasan)</span>
                    </div>
                    <button class="btn btn-primary">Tulis Ulasan</button>
                </div>
                
                <div class="border-top pt-3">
                    <!-- Review Item -->
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <div class="fw-bold">Budi Santoso</div>
                            <small class="text-muted">2 minggu lalu</small>
                        </div>
                        <div class="mb-2">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= 5)
                                    <i class="fas fa-star text-warning small"></i>
                                @else
                                    <i class="far fa-star text-warning small"></i>
                                @endif
                            @endfor
                        </div>
                        <p>Sepatu sangat nyaman dipakai, bahannya berkualitas. Ukurannya pas sesuai yang saya pesan.</p>
                    </div>
                    
                    <!-- Tambahkan lebih banyak review -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Related Products -->
<div class="row mt-5">
    <div class="col-12">
        <h4 class="fw-bold mb-4">Produk Lainnya</h4>
        <div class="row g-4">
            @for($i = 1; $i <= 4; $i++)
                <div class="col-md-3 col-6">
                    @include('products.partials.product-card', [
                        'product' => (object)[
                            'id' => $i,
                            'name' => 'Sepatu Sneakers A' . ($i+1),
                            'price' => 450000 + ($i * 50000),
                            'discount' => $i % 2 == 0 ? 15 : 0,
                            'image' => 'https://source.unsplash.com/random/300x300/?shoes-' . ($i+10),
                            'rating' => rand(3, 5),
                            'stock' => rand(5, 50)
                        ]
                    ])
                </div>
            @endfor
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function changeImage(element) {
        // Update main image
        document.getElementById('mainImage').src = element.src;
        
        // Update active thumbnail
        document.querySelectorAll('.thumbnail').forEach(thumb => {
            thumb.classList.remove('active');
        });
        element.classList.add('active');
    }
    
    function selectSize(element) {
        document.querySelectorAll('.size-option').forEach(size => {
            size.classList.remove('selected');
        });
        element.classList.add('selected');
    }
    
    function selectColor(element) {
        document.querySelectorAll('.color-option').forEach(color => {
            color.classList.remove('selected');
        });
        element.classList.add('selected');
    }
    
    function increaseQuantity() {
        const input = document.getElementById('quantity');
        input.value = parseInt(input.value) + 1;
    }
    
    function decreaseQuantity() {
        const input = document.getElementById('quantity');
        if (parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
        }
    }
</script>
@endsection