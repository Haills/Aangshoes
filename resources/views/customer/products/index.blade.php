@extends('layouts.app')

@section('title', 'Katalog Produk - Aangshoes')

@section('styles')
<style>
    .product-img {
        height: 200px;
        object-fit: cover;
        transition: transform 0.3s;
    }
    
    .product-card:hover .product-img {
        transform: scale(1.05);
    }
    
    .price {
        font-weight: 600;
        color: var(--primary);
    }
    
    .discount-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        background: var(--danger);
        color: white;
        padding: 3px 8px;
        border-radius: 4px;
        font-size: 0.8rem;
        font-weight: 500;
    }
    
    .filter-section {
        background: white;
        border-radius: 8px;
        padding: 1.5rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
</style>
@endsection

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h1 class="fw-bold">Katalog Sepatu</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Produk</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row g-4">
    <!-- Filter Section -->
    <div class="col-lg-3">
        @include('products.partials.filter')
    </div>
    
    <!-- Product List -->
    <div class="col-lg-9">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="mb-0">Menampilkan 12 produk</h5>
            <div class="dropdown">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    Urutkan: Terbaru
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Terbaru</a></li>
                    <li><a class="dropdown-item" href="#">Harga Tertinggi</a></li>
                    <li><a class="dropdown-item" href="#">Harga Terendah</a></li>
                    <li><a class="dropdown-item" href="#">Diskon Terbesar</a></li>
                </ul>
            </div>
        </div>
        
        <div class="row g-4">
            @for($i = 1; $i <= 12; $i++)
                <div class="col-md-4 col-6">
                    @include('products.partials.product-card', [
                        'product' => (object)[
                            'id' => $i,
                            'name' => 'Sepatu Sneakers A' . $i,
                            'price' => 450000 + ($i * 50000),
                            'discount' => $i % 3 == 0 ? 20 : 0,
                            'image' => 'https://source.unsplash.com/random/300x300/?shoes-' . $i,
                            'rating' => rand(3, 5),
                            'stock' => rand(5, 50)
                        ]
                    ])
                </div>
            @endfor
        </div>
        
        <nav class="mt-5">
            <ul class="pagination justify-content-center">
                <li class="page-item disabled">
                    <a class="page-link" href="#">Previous</a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>
    </div>
</div>
@endsection