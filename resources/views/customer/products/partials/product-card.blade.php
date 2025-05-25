<div class="card product-card h-100 border-0 shadow-sm overflow-hidden">
    <div class="position-relative overflow-hidden" style="height: 200px;">
        <img src="{{ $product->image }}" class="product-img w-100" alt="{{ $product->name }}">
        @if($product->discount > 0)
            <span class="discount-badge">{{ $product->discount }}% OFF</span>
        @endif
    </div>
    <div class="card-body">
        <h6 class="card-title mb-2">{{ $product->name }}</h6>
        <div class="d-flex align-items-center mb-2">
            @for($i = 1; $i <= 5; $i++)
                @if($i <= $product->rating)
                    <i class="fas fa-star text-warning small"></i>
                @else
                    <i class="far fa-star text-warning small"></i>
                @endif
            @endfor
            <span class="ms-2 small">({{ rand(10, 100) }})</span>
        </div>
        <div class="d-flex align-items-center">
            @if($product->discount > 0)
                <span class="price">Rp {{ number_format($product->price * (1 - $product->discount/100), 0, ',', '.') }}</span>
                <span class="text-decoration-line-through text-muted small ms-2">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
            @else
                <span class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
            @endif
        </div>
    </div>
    <div class="card-footer bg-white border-0">
        <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary w-100">
            <i class="fas fa-eye me-1"></i> Detail
        </a>
    </div>
</div>