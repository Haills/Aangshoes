@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <!-- Card 1: Total Produk -->
    <div class="bg-white p-6 rounded-lg shadow">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                <i class="fas fa-box-open text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-gray-500">Total Produk</p>
                <h3 class="text-2xl font-bold">{{ $totalProducts }}</h3>
            </div>
        </div>
    </div>

    <!-- Card 2: Total Kategori -->
    <div class="bg-white p-6 rounded-lg shadow">
        <!-- Similar structure -->
    </div>

    <!-- Card 3: Total Pesanan -->
    <div class="bg-white p-6 rounded-lg shadow">
        <!-- Similar structure -->
    </div>
</div>

<div class="mt-8 bg-white p-6 rounded-lg shadow">
    <h2 class="text-xl font-semibold mb-4">Pesanan Terbaru</h2>
    <table class="min-w-full">
        <!-- Order table content -->
    </table>
</div>
@endsection