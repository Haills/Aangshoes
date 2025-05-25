@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
<h1 class="text-2xl font-bold mb-6">Edit Produk</h1>

@if ($errors->any())
    <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="max-w-lg">
    @csrf
    @method('PUT')

    <label class="block mb-2 font-semibold">Nama Produk</label>
    <input type="text" name="name" value="{{ old('name', $product->name) }}" class="w-full border p-2 rounded mb-4" required>

    <label class="block mb-2 font-semibold">Deskripsi</label>
    <textarea name="description" rows="4" class="w-full border p-2 rounded mb-4" required>{{ old('description', $product->description) }}</textarea>

    <label class="block mb-2 font-semibold">Harga (Rp)</label>
    <input type="number" name="price" value="{{ old('price', $product->price) }}" class="w-full border p-2 rounded mb-4" min="0" required>

    <label class="block mb-2 font-semibold">Stok</label>
    <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="w-full border p-2 rounded mb-4" min="0" required>

    <label class="block mb-2 font-semibold">Kategori</label>
    <select name="category_id" class="w-full border p-2 rounded mb-4" required>
        <option value="">-- Pilih Kategori --</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>{{ $category->name }}</option>
        @endforeach
    </select>

    <label class="block mb-2 font-semibold">Gambar Produk (boleh lebih dari 1)</label>
    <input type="file" name="images[]" multiple accept="image/*" class="mb-4">

    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Update</button>
</form>
@endsection
