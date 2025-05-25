@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
<div class="container mx-auto py-8">
    <div class="flex items-center mb-4">
        <a href="{{ route('orders.index') }}" class="text-blue-600 hover:underline flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Back to Orders
        </a>
    </div>

    <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-6">
        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
            <h3 class="text-lg font-medium">Order #{{ $order->id }}</h3>
            <p class="mt-1 text-sm text-gray-600">
                Placed on {{ $order->created_at->format('F j, Y \a\t g:i a') }}
            </p>
        </div>
        
        <div class="px-4 py-5 sm:p-6">
            <div class="mb-6">
                <h4 class="font-medium mb-2">Status</h4>
                <span class="px-3 py-1 rounded-full text-sm 
                    {{ $order->status === 'completed' ? 'bg-green-100 text-green-800' : 
                       ($order->status === 'cancelled' ? 'bg-red-100 text-red-800' : 
                       'bg-yellow-100 text-yellow-800') }}">
                    {{ ucfirst($order->status) }}
                </span>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                <div>
                    <h4 class="font-medium mb-2">Shipping Address</h4>
                    <p class="text-gray-600 whitespace-pre-line">{{ $order->shipping_address }}</p>
                </div>

                <div>
                    <h4 class="font-medium mb-2">Order Summary</h4>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span>Subtotal:</span>
                            <span>Rp {{ number_format($order->items->sum('price'), 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between font-medium border-t border-gray-200 pt-2">
                            <span>Total:</span>
                            <span>Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
            <h3 class="text-lg font-medium">Order Items</h3>
        </div>
        
        <div class="px-4 py-5 sm:p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Product</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Qty</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($order->items as $item)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded" src="{{ asset('storage/'.$item->product->image) }}" alt="">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $item->product->name }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                Rp {{ number_format($item->price, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $item->quantity }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection