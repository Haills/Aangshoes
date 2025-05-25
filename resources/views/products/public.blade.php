@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<h1 class="text-3xl font-bold mb-8 text-center">Selamat datang di Aangshoes</h1>

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    @foreach($products as $product)
    <div class="bg-white rounded shadow p-4 flex flex-col">
        @if($product->images->first())
            <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" alt="gambar" class="w-full h-48 object-cover mb-4 rounded">
        @else
            <div class="h-48 bg-gray-200 flex items-center justify-center mb-4 rounded text-gray-400">
                Tidak ada gambar
            </div>
        @endif

        <h2 class="text-lg font-semibold mb-2">{{ $product->name }}</h2>
        <p class="text-green-700 font-bold mb-2">Rp {{ number_format($product->price, 0, ',', '.') }}</p>

        <a href="{{ route('products.show', $product->id) }}" class="mt-auto bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 text-center">Lihat Detail</a>
    </div>
    @endforeach
</div>

<div class="mt-6">
    {{ $products->links() }}
</div>
@endsection
