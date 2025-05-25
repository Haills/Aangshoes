<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        return view('products.index', [
            'products' => Product::with('category')->latest()->paginate(10)
        ]);
    }
    public function publicIndex()
    {
        $products = Product::with('category')->latest()->paginate(12);
        return view('products.public', compact('products'));
    }
    public function create()
    {
        return view('products.create', [
            'categories' => Category::all()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $this->validateProduct($request);
        $product = Product::create($validated + ['slug' => Str::slug($request->name)]);

        $this->handleProductImages($request, $product);

        return redirect()->route('products.index')->with('success', 'Product added successfully');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('products.edit', [
            'product' => $product,
            'categories' => Category::all()
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $validated = $this->validateProduct($request);
        $product->update($validated + ['slug' => Str::slug($request->name)]);

        $this->handleProductImages($request, $product);

        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    public function destroy(Product $product)
    {
        $this->deleteProductImages($product);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }

    protected function validateProduct(Request $request)
    {
        return $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
    }

    protected function handleProductImages(Request $request, Product $product)
    {
        if (!$request->hasFile('images')) return;

        foreach ($request->file('images') as $image) {
            $path = $image->store('product_images', 'public');
            $product->images()->create(['image_path' => $path]);
        }
    }

    protected function deleteProductImages(Product $product)
    {
        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->image_path);
            $image->delete();
        }
    }
}
