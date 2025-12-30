<?php

namespace App\Http\Controllers\store;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $sizes = ProductVariant::distinct()->pluck('size')->sort()->values();
        $perPage = $request->input('per_page', 12);
        $sortBy = $request->input('sort_by', 'newest');
        $categories = Category::all();
        $products = Product::with(['category', 'images'])
            ->ByCategory($request->category_id)
            ->ByPrice($request->min_price, $request->max_price)
            ->BySize($request->sizes)
            ->sorted($sortBy)
            ->paginate($perPage);
        return view('store.shop', compact('products', 'categories', 'sizes'));
    }
}
