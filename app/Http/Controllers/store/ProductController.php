<?php

namespace App\Http\Controllers\store;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function showProduct(string $id, string $slug)
    {
        $product = Product::with(['variants', 'offer', 'reviews'])->where('status', 'in_stock')->findOrFail($id);
        $relatedProducts = $this->RelatedProduct($product);
        $totalReviews = $product->reviews()->count();
        $reviewsAvg = $product->reviews()->avg('rating');
        return view('store.product-details', [
            'product' => $product,
            'relatedProducts' => $relatedProducts,
            'totalReviews' => $totalReviews,
            'reviewsAvg' => $reviewsAvg,
        ]);
    }


    private function RelatedProduct($product)
    {
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)->limit(6)->get();
        return $relatedProducts;
    }


}
