<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\dashboard\StoreProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Size;
use App\Models\Variation;
use App\Services\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['variants', 'images'])->orderBy('created_at', 'DESC')->get();
        return view('dashboard.product.all-products', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $colors = Color::all();
        $sizes = Size::all();
        return view('dashboard.product.create-product', compact(
            'categories',
            'brands',
            'colors',
            'sizes'
        ));
    }


    public function store(StoreProductRequest $request)
    {
        $ValidatedData = $request->validated();
        $product = Arr::only($ValidatedData, ['name', 'price', 'description',
        'status',
        'brand_id',
        'category_id',]);
        $product['created_by'] = Auth::user()->first_name;
        $product['slug'] = Str::slug($ValidatedData['name']);
        $product = Product::create($product);
        $variations = [];
        foreach($ValidatedData['colors'] as $key => $color) {
            $variations = [
                'color_id' => $color,
                'size_id' => $ValidatedData['sizes'][$key],
                'stock' => $ValidatedData['stock'][$key],
            ];
            $product->variants()->create($variations);
        }
        foreach($ValidatedData['images'] as $key => $image) {
            $media = new Media;
            $newImage = $media->UploadMedia($image, 'products');
            $product->images()->create([
                'url' => $newImage,
                'alt' => " image for $product->name",
                ]);
        }
        return redirect()->back()->with('success', 'Product created successfully');
    }

    public function edit($id) {
        $product = Product::find($id);
        $categories = Category::all();
    }



}
