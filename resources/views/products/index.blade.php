@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
<h1 class="text-2xl font-bold mb-6">Daftar Produk</h1>

@if(session('success'))
    <div class="bg-green-100 p-3 mb-4 rounded text-green-700">
        {{ session('success') }}
    </div>
@endif

<a href="{{ route('products.create') }}" class="mb-4 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Tambah Produk</a>

<table class="min-w-full bg-white border rounded shadow">
    <thead>
        <tr>
            <th class="py-2 px-4 border-b">Gambar</th>
            <th class="py-2 px-4 border-b">Nama</th>
            <th class="py-2 px-4 border-b">Kategori</th>
            <th class="py-2 px-4 border-b">Harga</th>
            <th class="py-2 px-4 border-b">Stok</th>
            <th class="py-2 px-4 border-b">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
        <tr class="text-center border-b">
            <td class="py-2 px-4">
                @if($product->images->first())
                    <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" alt="gambar" class="w-16 h-16 object-cover mx-auto rounded">
                @else
                    <span class="text-gray-400">Tidak ada gambar</span>
                @endif
            </td>
            <td class="py-2 px-4">{{ $product->name }}</td>
            <td class="py-2 px-4">{{ $product->category->name }}</td>
            <td class="py-2 px-4">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
            <td class="py-2 px-4">{{ $product->stock }}</td>
            <td class="py-2 px-4">
                <a href="{{ route('products.edit', $product->id) }}" class="text-blue-600 hover:underline mr-3">Edit</a>

                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="mt-4">
    {{ $products->links() }}
</div>
@endsection
