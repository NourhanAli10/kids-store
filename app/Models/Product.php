<?php

namespace App\Models;

use App\Models\Brand;
use App\Models\Image;
use App\Models\Category;
use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'description',
        'brand_id',
        'category_id',
        'slug',
        'featured',
    ];



    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function variants() {
        return $this->hasMany(ProductVariant::class);
    }

    public function images() {
        return $this->hasMany(Image::class);
    }

    public function sizes() {
        return $this->belongsToMany(Size::class, 'product_variants', 'product_id', 'size_id');
    }
    public function colors()
    {
        return $this->belongsToMany(Color::class, 'product_variants', 'product_id', 'color_id');
    }

    public function reviews() {
        return $this->hasMany(Review::class);
    }

     public function cartItems()
    {
        return $this->hasMany(Cart::class);
    }

    public function wishlistProducts() {
        return $this->hasMany(Wishlist::class);
    }



}
