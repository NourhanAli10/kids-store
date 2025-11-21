<?php

namespace App\Http\Controllers\store;

use App\Http\Controllers\Controller;
use App\Services\CouponService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Cast\String_;

class CouponController extends Controller
{
    protected $couponService;

    public function __construct(CouponService $couponService)
    {
        $this->couponService = $couponService;

    }

   public function applyCoupon(Request $request) {

    $request->validate([
        'coupon_code' => 'required|exists:Coupons,code',
        'subtotal' => 'required|numeric',
    ]);
    $userId = Auth::id();
    try {
        $coupon = $this->couponService->validateCoupon($request->coupon_code ,$userId, $request->subtotal);
        $discount = $this->couponService->calculateDiscount($coupon, $request->subtotal);
        session([
            'applied_coupon' => [
            'code' => $coupon->code,
            'id' => $coupon->id,
            'discount' => $discount,
            'total_after_discount' => $request->subtotal - $discount,
            ]
        ]);
        return back()->with('success', "Coupon applied! You saved " . number_format($discount, 2));
     } catch(\Exception $e) {
        return back()->with('error', $e->getMessage());
     }
   }


   public function removeCoupon() {
    session()->forget('applied_coupon');
    return back()->with('success', 'Coupon removed');
   }
}
