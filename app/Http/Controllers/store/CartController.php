<?php

namespace App\Http\Controllers\store;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \Darryldecode\Cart\Facades\CartFacade as Cart;
use App\Models\Cart as cartModel;

class CartController extends Controller
{

    public function addToCart(Request $request)
    {

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'color_id' => 'required',
            'size_id' => 'required',

        ]);
        $product = Product::findorFail($request->product_id);
        $variant = $product->variants()->where('color_id', $request->color_id)
            ->where('size_id', $request->size_id)->first();

        $cartItem =  Cart::getContent()->where('id', $request->product_id)
            ->where('attributes.color', $request->color)
            ->where('attributes.size', $request->size)
            ->first();
        if ($cartItem) {
            $cartItem =  Cart::update($cartItem->id, array(
                'quantity' => [
                    'relative' => false,
                    'value' => $cartItem->quantity + $request->quantity,
                ],
            ));
        } else {
            $cartItem = Cart::add(array(
                'id' => $request->product_id,
                'name' => $product->name,
                'price' => $product->price,

                'attributes' => [
                    'color' => $variant->color->name,
                    'size' => $variant->size->name,
                    'category' => $product->category->name,
                    'images' => $product->images->pluck('url')->toArray(),
                    'slug' => $product->slug,
                    'stock' => $variant->stock,
                ],
                'quantity' => $request->quantity,
            ));
        }

        if (Auth::check()) {
            $userId = Auth::user()->id;
            $this->saveCartToDatabase($userId, $request->product_id);
        }
        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function saveCartToDatabase(string $userId)
    {
        $sessionCart = Cart::getContent();
        foreach ($sessionCart as $item) {
            cartModel::updateOrCreate(
                [
                    'user_id' => $userId,
                    'product_id' => $item->id,
                ],
                [
                    'product_id' => $item->id,
                    'name' => $item->name,
                    'user_id' => $userId,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'color' => $item->attributes->color,
                    'size' => $item->attributes->size,
                ]
            );
        }
    }

    public function viewCart()
    {
        $user = Auth::user();
        $cartItems = Cart::getContent();

        if (Auth::check()) {
            $cartItems =  cartModel::with('product')->where('user_id', $user->id)->get();
        }
        return view('store.cart', compact('cartItems'));
    }

    public function updateCart(Request $request)
    {
        $request->validate([
            'quantities' => 'required|array',
            'quantities.*' => 'required|integer|min:1',
        ]);

        if (Auth::check()) {
            $userId = Auth::user()->id;
            foreach ($request->quantities as $cartItemId  => $quantity) {
                $cartItem = cartModel::where('user_id', $userId)
                    ->where('id', $cartItemId)
                    ->first();
                if ($cartItem) {
                    $cartItem->quantity = $quantity;
                    $cartItem->save();
                }
            }
            return redirect()->back()->with('success', 'cart has been updated successfully');
        } else {
            foreach ($request->quantities as $productId  => $quantity) {

                Cart::update($productId, array(
                    'quantity' => [
                        'relative' => false,
                        'value' =>  $quantity,
                    ],
                ));
            }
            return redirect()->back()->with('success', 'cart has been updated successfully');
        }
    }

    public function removeFromCart(string $id)
    {
        if (Cart::has($id)) {
            Cart::remove($id);
        }
        if (Auth::check()) {
            cartModel::where('user_id', Auth::user()->id)
                ->where('product_id', $id)->delete();
        }
        return redirect()->back()->with('success', 'Product removed from cart!');
    }


    public function clearCart()
    {
        if (Auth::check()) {
            cartModel::where('user_id', Auth::id())->delete();
            return redirect()->back()->with('success', 'cart has been cleared');
        } else {
            Cart::clear();
            return redirect()->back()->with('success', 'cart has been cleared');
        }
    }
}
