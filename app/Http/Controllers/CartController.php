<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = session('cart', []);
        $products = Product::whereIn('id', array_keys($cartItems))
                        ->get()
                        ->keyBy('id');

        $total = array_reduce(array_keys($cartItems), function ($carry, $productId) use ($products, $cartItems) {
            return $carry + ($products[$productId]->price * $cartItems[$productId]['quantity']);
        }, 0);

        return view('cart.index', compact('products', 'cartItems', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        $cart = session('cart', []);
        $quantity = $request->input('quantity', 1);

        Arr::set($cart, $product->id, [
            'quantity' => ($cart[$product->id]['quantity'] ?? 0) + $quantity,
            'added_at' => now()->toDateTimeString()
        ]);

        session(['cart' => $cart]);

        return back()->withSuccess("{$product->name} added to cart");
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1|max:20' // Increased max to 20
        ]);

        $cart = session('cart', []);

        if (Arr::has($cart, $product->id)) {
            $cart[$product->id]['quantity'] = $validated['quantity'];
            session(['cart' => $cart]);
        }

        return redirect()->route('cart.index')->withSuccess('Cart updated');
    }

    public function remove(Product $product)
    {
        $cart = session('cart', []);

        if (Arr::has($cart, $product->id)) {
            Arr::forget($cart, $product->id);
            session(['cart' => $cart]);
        }

        return back()->withSuccess("{$product->name} removed from cart");
    }

    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.index')->withSuccess('Cart cleared');
    }
}