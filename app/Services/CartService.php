<?php

namespace App\Services;

class CartService
{
    public function count(): int
    {
        $cart = session()->get('cart', []);
        return array_reduce($cart, fn($carry, $item) => $carry + $item['quantity'], 0);
    }

    public function total(): float
    {
        $cart = session()->get('cart', []);
        $total = 0;

        foreach ($cart as $productId => $item) {
            $product = \App\Models\Product::find($productId);
            if ($product) {
                $total += $product->price * $item['quantity'];
            }
        }

        return $total;
    }

    // Tambahkan method lain sesuai kebutuhan
}
