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
            'color' => 'required',
            'size' => 'required',

        ]);
        $product = Product::findorFail($request->product_id);

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
                    'color' => $request->color,
                    'size' => $request->size,
                    'category' => $product->category->name,
                    'images' => $product->images,
                ],
                'quantity' => $request->quantity,
            ));
        }

        if (Auth::check()) {
            $userId = Auth::user()->id;
            $this->saveCartToDatabase($userId);
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
        $cartItems = Cart::getContent();
        $user = Auth::user();
        if ( Auth::check()) {
           $cartItems =  cartModel::with('product.images')->where('user_id' , $user->id)->get();
        }
        return view('store.cart', compact('cartItems'));
    }

    public function updateCart(Request $request)
    {
        Cart::update($request->product_id, array(
            'quantity' => [
                'relative' => false,
                'value' =>  $request->quantity,
            ],
        ));
        if (Auth::check()) {
            $userId = Auth::user()->id;
            cartModel::updateOrCreate(
                [
                    'user_id' => $userId,
                    'product_id' => $request->product_id,
                ],
                [
                    'quantity' => $request->quantity,
                ]
            );
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
}
