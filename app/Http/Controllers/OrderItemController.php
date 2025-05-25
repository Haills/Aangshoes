<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    public function update(Request $request, OrderItem $item)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1|max:100' // Added max limit
        ]);

        $item->update([
            'quantity' => $validated['quantity'],
            'price' => $item->product->price * $validated['quantity']
        ]);

        return back()->withSuccess('Order item updated successfully');
    }

    public function destroy(OrderItem $item)
    {
        try {
            $item->delete();
            return back()->withSuccess('Order item removed successfully');
        } catch (\Exception $e) {
            return back()->withError('Failed to remove order item');
        }
    }
}