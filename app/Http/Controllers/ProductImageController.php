<?php

namespace App\Http\Controllers;

use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;

class ProductImageController extends Controller
{
    public function destroy(ProductImage $image)
    {
        try {
            Storage::disk('public')->delete($image->image_path);
            $image->delete();

            return back()->with('success', 'Image deleted successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete image');
        }
    }
}