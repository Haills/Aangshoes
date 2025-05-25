<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Halaman utama untuk tamu
    public function index()
    {
        return view('customer.home', [
            'products' => Product::latest()->take(8)->get(),
            'categories' => Category::withCount('products')
                ->orderByDesc('products_count')
                ->take(5)
                ->get()
        ]);
    }

    // Halaman dashboard untuk user yang login
    public function dashboard()
    {
        return view('admin.dashboard', [
            'totalProducts' => Product::count(),
            'totalCategories' => Category::count(),
            'recentOrders' => Order::latest()->take(5)->get()
        ]);
    }
}
