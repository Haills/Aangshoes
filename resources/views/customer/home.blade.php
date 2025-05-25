@extends('layouts.app')

@section('title', 'Home - ShoeStore')

@section('content')
<div class="bg-gray-50">
    <!-- Hero Section -->
    <div class="relative bg-blue-600 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h1 class="text-4xl font-bold mb-6">Step Into Style</h1>
            <p class="text-xl mb-8">Discover the latest trends in footwear</p>
            <a href="{{ route('products.index') }}" 
               class="bg-white text-blue-600 px-8 py-3 rounded-full font-semibold hover:bg-gray-100 transition">
                Shop Now
            </a>
        </div>
    </div>

    <!-- Featured Products -->
    <div class="max-w-7xl mx-auto px-4 py-16">
        <h2 class="text-3xl font-bold text-center mb-12">New Arrivals</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($products as $product)
                @include('components.product-card', ['product' => $product])
            @endforeach
        </div>
    </div>

    <!-- Categories -->
    <div class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Shop by Category</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($categories as $category)
                    <a href="{{ route('category.show', $category->slug) }}" 
                       class="group relative block overflow-hidden rounded-lg shadow-lg hover:shadow-xl transition">
                        <img src="{{ asset('storage/'.$category->image) }}" 
                             alt="{{ $category->name }}" 
                             class="w-full h-48 object-cover">
                        <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
                            <h3 class="text-white text-2xl font-bold group-hover:text-blue-400 transition">
                                {{ $category->name }}
                            </h3>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
