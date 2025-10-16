<?php

namespace App\Http\Controllers\store;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function showProduct(string $id, string $slug)
    {
        $product = Product::findOrFail($id);
        $colors = $product->colors;
        $relatedProducts = $this->RelatedProduct($product);
        $reviews = $product->reviews;
        return view('store.product-detail', compact('product', 'colors', 'reviews', 'relatedProducts'));
    }


    private function RelatedProduct($product) {
        $relatedProducts = Product::where('category_id', $product->category_id)
        ->where('id' ,'!=' ,$product->id)->limit(6)->get();
        return $relatedProducts;
    }









}
