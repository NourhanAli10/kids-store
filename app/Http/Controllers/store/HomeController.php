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
        $productsWithOffers = Product::whereHas('offer')->get();
        $deals = Product::whereHas('offer' , function($query) {
            $query->where('end_date', '<', now()->addDays(7));
        })->where('status', 'in_stock')->limit(2)->get();

        return view('store.index', compact('products', 'newArrivals', 'categories', 'featuredProducts', 'productsWithOffers', 'deals'));
    }


    public function AboutUs() {
        return view('store.about-us');
    }




}
