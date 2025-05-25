<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description'
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
    public function getPopularCategories()
{
    return $this->withCount(['products' => function($query) {
            $query->where('stock', '>', 0);
        }])
        ->having('products_count', '>', 0)
        ->orderByDesc('products_count')
        ->limit(5)
        ->get();
}
}