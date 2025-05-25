@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <h1 class="text-2xl font-bold mb-6">Keranjang Belanja</h1>
    
    @if(count($cartItems) > 0)
        <div class="divide-y divide-gray-200">
            @foreach($products as $product)
                <div class="py-4 flex flex-col md:flex-row">
                    <!-- Product Image -->
                    <div class="w-full md:w-1/4">
                        <img src="{{ asset('storage/'.$product->images->first()->image_path) }}" 
                             class="w-full h-auto rounded">
                    </div>
                    
                    <!-- Product Info -->
                    <div class="w-full md:w-2/4 px-4">
                        <h3 class="text-lg font-semibold">{{ $product->name }}</h3>
                        <p class="text-gray-600">{{ $product->category->name }}</p>
                    </div>
                    
                    <!-- Quantity & Price -->
                    <div class="w-full md:w-1/4 flex flex-col items-end">
                        <form action="{{ route('cart.update', $product->id) }}" method="POST" class="mb-2">
                            @csrf
                            @method('PUT')
                            <input type="number" name="quantity" 
                                   value="{{ $cartItems[$product->id]['quantity'] }}" 
                                   min="1" max="10"
                                   class="w-20 px-2 py-1 border rounded">
                        </form>
                        <p class="text-lg font-semibold">
                            Rp {{ number_format($product->price * $cartItems[$product->id]['quantity']) }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- Checkout Section -->
        <div class="mt-6 border-t pt-6">
            <div class="flex justify-between items-center">
                <h3 class="text-xl font-semibold">Total: Rp {{ number_format($total) }}</h3>
                <a href="{{ route('cart.checkout') }}" 
                   class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
                    Checkout
                </a>
            </div>
        </div>
    @else
        <div class="text-center py-12">
            <p class="text-gray-500 mb-4">Keranjang belanja Anda kosong</p>
            <a href="{{ route('home') }}" class="text-blue-600 hover:underline">
                Mulai Belanja
            </a>
        </div>
    @endif
</div>
@endsection