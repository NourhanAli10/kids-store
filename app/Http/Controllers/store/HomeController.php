<?php

namespace App\Http\Controllers\store;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $products =  Product::paginate(10);
        $newArrivals = Product::orderBy('created_at', 'desc')->limit(6)->get();
        $categories = Category::all();
        $featuredProducts = Product::where('featured', true)->get();
        return view('store.index', compact('products', 'newArrivals', 'categories', 'featuredProducts'));
    }


    public function AboutUs() {
        return view('store.about-us');
    }




}
