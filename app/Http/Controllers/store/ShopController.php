<?php

namespace App\Http\Controllers\store;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index() {
        $categories = Category::all();
        $products = Product::paginate(12);
        return view('store.shop', compact('products', 'categories'));
    }
}
