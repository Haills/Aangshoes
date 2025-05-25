<div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition">
    <a href="{{ route('products.show', $product->slug) }}" class="block relative">
        <!-- Product Image -->
        <img src="{{ asset('storage/'.$product->images->first()->image_path) }}" 
             alt="{{ $product->name }}" 
             class="w-full h-64 object-cover">
        
        <!-- Badge -->
        @if($product->stock < 10 && $product->stock > 0)
            <span class="absolute top-2 right-2 bg-red-500 text-white px-3 py-1 rounded-full text-xs">
                Almost Gone!
            </span>
        @endif
    </a>

    <div class="p-4">
        <!-- Category -->
        <div class="text-sm text-gray-500 mb-2">
            {{ $product->category->name }}
        </div>

        <!-- Product Name -->
        <a href="{{ route('products.show', $product->slug) }}" 
           class="block text-lg font-semibold text-gray-800 hover:text-blue-600 transition">
            {{ $product->name }}
        </a>

        <!-- Price -->
        <div class="my-3">
            <span class="text-2xl font-bold text-blue-600">
                ${{ number_format($product->price) }}
            </span>
        </div>

        <!-- Add to Cart -->
        @if($product->stock > 0)
            <form action="{{ route('cart.add', $product) }}" method="POST">
                @csrf
                <button type="submit" 
                        class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition flex items-center justify-center">
                    <i class="fas fa-cart-plus mr-2"></i>
                    Add to Cart
                </button>
            </form>
        @else
            <button disabled 
                    class="w-full bg-gray-400 text-white py-2 rounded-lg cursor-not-allowed">
                Out of Stock
            </button>
        @endif
    </div>
</div>