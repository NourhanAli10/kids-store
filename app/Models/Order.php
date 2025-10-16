<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;


    protected $fillable = [
        'order_number',
        'user_id',
        'shipping_first_name',
        'shipping_last_name',
        'shipping_phone',
        'shipping_address_type',
        'shipping_address',
        'shipping_town',
        'shipping_city',
        'status',
        'subtotal',
        'tax_amount',
        'shipping_cost',
        'discount_amount',
        'total_amount',
        'payment_status',
        'payment_method',
        'payment_transaction_id',
        'order_note',
        'shipped_at',
        'delivered_at',

    ];

    public function orderItems() {
        return $this->hasMany(OrderItem::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }



}
