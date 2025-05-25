@extends('layouts.app')

@section('title', $product->name)

@section('content')
<h1 class="text-2xl font-bold mb-6">{{ $product->name }}</h1>

<div class="flex flex-col md:flex-row gap-6">
    <div class="md:w-1/2">
        @if($product->images->count() > 0)
            <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" alt="Gambar Produk" class="w-full rounded shadow">
        @else
            <p class="text-gray-500">Tidak ada gambar tersedia.</p>
        @endif
    </div>
    <div class="md:w-1/2">
        <p class="mb-4"><strong>Kategori:</strong> {{ $product->category->name }}</p>
        <p class="mb-4"><strong>Harga:</strong> Rp {{ number_format($product->price, 0, ',', '.') }}</p>
        <p class="mb-4"><strong>Stok:</strong> {{ $product->stock }}</p>
        <p class="mb-4"><strong>Deskripsi:</strong></p>
        <p>{{ $product->description }}</p>

        @auth
            @if(auth()->user()->is_admin)
                <a href="{{ route('products.edit', $product->id) }}" class="inline-block mt-4 bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Edit Produk</a>
            @else
                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-4">
                    @csrf
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Tambah ke Keranjang</button>
                </form>
            @endif
        @else
            <p class="mt-4 text-gray-600">Silakan <a href="{{ route('login') }}" class="text-blue-600 hover:underline">login</a> untuk membeli produk ini.</p>
        @endauth
    </div>
</div>
@endsection
