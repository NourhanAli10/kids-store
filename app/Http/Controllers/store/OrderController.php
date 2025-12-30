<?php

namespace App\Http\Controllers\store;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $filter = $request->get('filter', '5');
        $query = Order::where('user_id', $user->id)->with(['orderItems.product.images'])
        ->orderBy('created_at', 'desc');
        if ($filter === 'all') {
            $orders = $query->get();
        } else {
            $orders = $query->limit((int)$filter)->get();
        }
        return view('store.profile.orders', compact('orders'));
    }


    public function orderSuccess(string $id)
    {
        $order = Order::findOrFail($id);
        $orderItems = OrderItem::where('order_id', $id)->get();

        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized to view this order');
        }

        return view('store.order-confirmation', compact('order', 'orderItems'));
    }


    public function manageOrder(string $orderId)
    {
        $order = Order::where('id', $orderId)->with('orderItems')->first();
        return view('store.manage-order', compact('order'));
    }


    public function trackOrder()
    {
        return view('store.profile.track-order');
    }

    public function findOrder(Request $request)
    {

        $request->validate([
            'order_number' => 'required|exists:orders,order_number',
            'phone' => 'required',
        ]);
        $order = Order::where('order_number', $request->order_number)
            ->where('shipping_phone', $request->phone)->first();

        if (!$order) {
            return redirect()->back()
                ->with('error', 'Order not found. Please check your Order ID and Phone number.');
        }
        return view('store.profile.track-order', compact('order'))
        ->with('success', 'Order found successfully!');

    }

}
