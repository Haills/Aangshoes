<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        // Menggunakan Auth::id() untuk mendapatkan ID user yang login
        $orders = Order::where('user_id', Auth::id())
                     ->with(['items.product'])
                     ->latest()
                     ->paginate(10);

        return view('profile.orders.index', compact('orders'));
    }

    public function show($id) // Mengubah parameter menjadi $id untuk menghindari route model binding issue
    {
        $order = Order::with(['items.product'])
                     ->where('id', $id)
                     ->where('user_id', Auth::id())
                     ->firstOrFail();

        return view('profile.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::where('id', $id)
                     ->where('user_id', Auth::id())
                     ->firstOrFail();

        $validated = $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled,refunded'
        ]);

        $order->update($validated);

        return back()->with('success', 'Order status updated successfully');
    }
}