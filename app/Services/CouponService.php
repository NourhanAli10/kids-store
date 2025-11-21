<?php

namespace App\Services;

use App\Models\Coupon;
use App\Models\CouponHistory;
use Exception;
use Illuminate\Support\Facades\Auth;

class CouponService
{
    public function validateCoupon($code , $userId, $orderAmount)
    {

        $coupon = Coupon::where('code', $code)->first();
        if (!$coupon) {
            throw new Exception('Ivalid coupon code');
        }

        if (!$coupon->isValid()) {
            throw new Exception('This coupon is not valid or has expired.');
        }
        if (!$coupon->canUsedByUser($userId)) {
            throw new Exception('This coupon cannot be used by the current user.');
        }
        if ($orderAmount < $coupon->min_order_amount) {
            throw new Exception("Minimum order amount is {$coupon->min_order_amount} ");
        }
        return $coupon;

    }


    public function calculateDiscount($coupon , $orderAmount) {
        if ($orderAmount < $coupon->min_order_amount) {
            $dicount = 0 ;
        }
        if($coupon->type == "percentage") {
            $discount = $orderAmount * ($coupon->value / 100);
        } else {
            $discount = $coupon->value ;
        }

        if ($coupon->max_discount && $discount > $coupon->max_discount) {
            $discount = $coupon->max_discount ;
        }

        return $discount;

    }


    public function recordUsage($CouponId , $UserId, $orderId , $discount) {
        $coupon = Coupon::find($CouponId);
        $coupon->increment('usage_count');
        CouponHistory::create([
            'user_id' => $UserId,
            'coupon_id' => $CouponId,
            'order_id' => $orderId,
            'discount_amount' => $discount
        ]);
    }



}
