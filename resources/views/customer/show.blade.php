@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="md:flex">
                <div class="md:w-1/2">
                    <!-- Gallery Produk -->
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            @foreach($product->images as $image)
                            <div class="swiper-slide">
                                <img src="{{ asset('storage/'.$image->image_path) }}" alt="{{ $product->name }}" class="w-full h-auto">
                            </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
                
                <div class="md:w-1/2 md:pl-8">
                    <h1 class="text-3xl font-bold text-gray-900">{{ $product->name }}</h1>
                    <p class="text-gray-500 mt-2">{{ $product->category->name }}</p>
                    
                    <div class="mt-4">
                        <span class="text-2xl font-bold text-gray-900">Rp {{ number_format($product->price) }}</span>
                        @if($product->stock > 0)
                            <span class="text-green-600 ml-2">Tersedia ({{ $product->stock }})</span>
                        @else
                            <span class="text-red-600 ml-2">Habis</span>
                        @endif
                    </div>
                    
                    <div class="mt-6">
                        <p class="text-gray-700">{{ $product->description }}</p>
                    </div>
                    
                    @if($product->stock > 0)
                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-8">
                        @csrf
                        <div class="flex items-center">
                            <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" 
                                   class="w-20 px-3 py-2 border border-gray-300 rounded-md">
                            <button type="submit" class="ml-4 bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600">
                                Tambah ke Keranjang
                            </button>
                        </div>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Inisialisasi Swiper untuk gallery produk
    new Swiper('.swiper-container', {
        pagination: {
            el: '.swiper-pagination',
        },
    });
</script>
@endpush