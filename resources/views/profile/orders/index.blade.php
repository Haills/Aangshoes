@extends('layouts.app')

@section('title', 'My Orders')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">My Orders</h1>
    
    @if($orders->isEmpty())
        <div class="bg-white p-6 rounded-lg shadow">
            <p>You haven't placed any orders yet.</p>
            <a href="{{ route('products.index') }}" class="text-blue-600 hover:underline">
                Start Shopping
            </a>
        </div>
    @else
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <ul class="divide-y divide-gray-200">
                @foreach($orders as $order)
                <li class="p-4 hover:bg-gray-50">
                    <a href="{{ route('orders.show', $order) }}" class="block">
                        <div class="flex justify-between">
                            <div>
                                <p class="font-medium">Order #{{ $order->id }}</p>
                                <p class="text-sm text-gray-500">
                                    {{ $order->created_at->format('M d, Y') }}
                                </p>
                            </div>
                            <div>
                                <span class="px-2 py-1 text-xs rounded-full 
                                    {{ $order->status === 'completed' ? 'bg-green-100 text-green-800' : 
                                       ($order->status === 'cancelled' ? 'bg-red-100 text-red-800' : 
                                       'bg-yellow-100 text-yellow-800') }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                                <p class="text-right mt-1 font-medium">
                                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    </a>
                </li>
                @endforeach
            </ul>
            {{ $orders->links() }}
        </div>
    @endif
</div>
@endsection