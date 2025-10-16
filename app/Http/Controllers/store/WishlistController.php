<?php

namespace App\Http\Controllers\store;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index() {
        $userId = Auth::user()->id;
        $wishlistItems = Wishlist::where('user_id', $userId)->with('product')->get();
        return view('store.wishlist', compact('wishlistItems'));
    }


    public function store(Request $request) {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);
        $productId= $request->product_id;
        $product = Product::where('id',$productId )->get();
        $user = Auth::user();
        $product = Wishlist::where('user_id', $user->id)
        ->where('product_id' , $productId)->exists();
        if($product) {
            return redirect()->back()->with('wishlist', 'The product already in wishlist');
        }
        else {
            Wishlist::create([
                'user_id' => $user->id,
                'product_id' => $productId,
            ]);
            return redirect()->back()->with('wishlist', 'the product has been added to wishlist');
        }
    }


    public function remove(string $productId) {
        $userId = Auth::user()->id;
        $wishlistItem =  Wishlist::where('user_id', $userId)->where('product_id', $productId)->first();
        if (! $wishlistItem) {
            return redirect()->back()->with('wishlist', 'product is not in wishlist');
        }
        else {
            $wishlistItem->delete();
             return redirect()->back()->with('wishlist', 'Product removed from wishlist');

        }
    }

    public function clear() {
        $user = Auth::user();
        $user->wishlists()->delete();
        return redirect()->route('wishlist')
                        ->with('wishlist', 'Wishlist cleared successfully');
    }


}
