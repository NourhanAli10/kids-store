<?php

namespace App\Http\Controllers\store;

use \Darryldecode\Cart\Facades\CartFacade as Cart;
use App\Http\Controllers\Controller;
use App\Http\Requests\store\OrderRequest;
use App\Models\Address;
use App\Models\Cart as CartModel;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $user = null;
        $address = null;
        $cartItems = null;

        if (Auth::check()) {
            $user = Auth::user();
            $defaultAddress =  $user->addresses->where('is_default', 'true')->first()
                ?? $user->addresses->first();
            $address = $defaultAddress;
            $cartItems = CartModel::with('product')->where('user_id', $user->id)->get();
            if ($cartItems->isEmpty()) {
                return redirect()->route('home.cart')->with('error', 'Your cart is empty');
            }
        }
        $subtotal = $cartItems->sum(function ($item) {
            return $item->quantity * $item->price;
        });
        $tax_amount = $subtotal * 0.14;

        $initialShippingCost = 0;
        if ($address && $address->city) {
            $initialShippingCost = $this->calculateShippingCost($address->city);
        }
        return view('store.checkout', compact(
            'cartItems',
            'user',
            'address',
            'subtotal',
            'tax_amount',
            'initialShippingCost'
        ));
    }


    public function processOrder(OrderRequest $request)
    {

        $user = Auth::user();
        $validatedData = $request->validated();
        $orderNumber =  date('Ymd') . '-' . strtoupper(uniqid());
        $cartItems = CartModel::with('product')->where('user_id', $user->id)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('home.cart')->with('error', 'Your cart is empty');
        }
        $subtotal = $cartItems->sum(function ($item) {
            return $item->quantity * $item->price;
        });
        $tax_amount = $subtotal * 0.14;
        $shippingCost =  $this->calculateShippingCost($validatedData['city']);
        $totalAmount = $subtotal + $shippingCost + $tax_amount;
        $shippingAddress = $this->handleOrderAddress($request, $validatedData, $user);
        $order = Order::create([
            'user_id' => $user->id,
            'order_number' => $orderNumber,
            /// Shipping address
            'shipping_first_name' =>  $shippingAddress['first_name'],
            'shipping_last_name' =>  $shippingAddress['last_name'],
            'shipping_phone' => $shippingAddress['phone'],
            'shipping_address_type' =>  $shippingAddress['address_type'],
            'shipping_address' =>  $shippingAddress['address'],
            'shipping_town' =>  $shippingAddress['town'],
            'shipping_city' =>  $shippingAddress['city'],
            'status' => 'pending',
            'subtotal' => $subtotal,
            'tax_amount' => $tax_amount,
            'shipping_cost' => $shippingCost,
            'total_amount' => $totalAmount,
            'order_note' => $validatedData['order_note'],
            'payment_status' => 'pending',
            'payment_method' =>  $validatedData['payment_method'],

        ]);

        foreach ($cartItems as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'product_name' => $cartItem->name,
                'quantity' => $cartItem->quantity,
                'unit_price' => $cartItem->price,
                'size' => $cartItem->size,
                'color' => $cartItem->color,
                'total_price' => $cartItem->quantity *  $cartItem->price,
            ]);
        }

        CartModel::where('user_id', $user->id)->delete();
        return redirect()->route('order.success', $order->id)->with('success', 'Order placed successfully!');
    }

    public function calculateShippingCost($city)
    {
        $shippingCost = [
            'Cairo' => 30.00,
            'Alexandria' => 35.00,
            'Giza' => 30.00,
            'Sharm El Sheikh' => 100.00,
            'Hurghada' => 45.00,

        ];

        return $shippingCost[$city] ?? 40.00;
    }


    /**
     * Get shipping cost - handles both regular calls and AJAX requests
     */

    public function getShippingCost(Request $request)
    {
        $city = $request->input('city');
        if (!$city) {
            return response()->json(['error' => 'City is required'], 400);
        }
        $shippingCost = $this->calculateShippingCost($city);

        return response()->json([
            'success' => true,
            'shipping_cost' => $shippingCost,
            'formatted_cost' => number_format($shippingCost, 2) . ' EGP'
        ]);
    }


    public function handleOrderAddress(Request $request, $validatedData, $user)
    {
        if ($request->has('ship_to_another_address')) {
            $shippingAddress = [
                'user_id' => $user->id,
                'first_name' => $validatedData['shipping_first_name'],
                'last_name' => $validatedData['shipping_last_name'],
                'phone' => $validatedData['phone'],
                'address_type' => $validatedData['shipping_address_type'],
                'address' => $validatedData['shipping_address'],
                'town' => $validatedData['shipping_town'],
                'city' => $validatedData['shipping_city'],
                'is_default' => false,
            ];
            if ($request->has('save_shipping_address')) {
                Address::create($shippingAddress);
            }
        } else {
            $defaultAddress = Address::where('user_id', $user->id)
                ->where('is_default', true)
                ->first();
            if ($defaultAddress) {
                $shippingAddress = [
                    'user_id' => $user->id,
                    'first_name' => $validatedData['first_name'],
                    'last_name' => $validatedData['last_name'],
                    'phone' => $validatedData['phone'],
                    'address_type' => $validatedData['address_type'],
                    'address' => $validatedData['address'],
                    'town' => $validatedData['town'],
                    'city' => $validatedData['city'],
                ];
                $defaultAddress->update($shippingAddress);
            } else {
                $shippingAddress = [
                    'user_id' => $user->id,
                    'first_name' => $validatedData['first_name'],
                    'last_name' => $validatedData['last_name'],
                    'phone' => $validatedData['phone'],
                    'address_type' => $validatedData['address_type'],
                    'address' => $validatedData['address'],
                    'town' => $validatedData['town'],
                    'city' => $validatedData['city'],
                    'is_default' => true,
                ];
                Address::create($shippingAddress);
            }
        }

        return $shippingAddress;
    }
}
