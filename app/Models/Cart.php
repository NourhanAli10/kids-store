<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'name',
        'quantity',
        'size',
    ];




    public function Product() {
        return $this->belongsTo(Product::class);
    }



    public function user()
    {
        return $this->belongsTo(User::class);
    }



    public function getProductVariant() {
        return $this->product->variants()->where('size', $this->size)->first();

    }


}
