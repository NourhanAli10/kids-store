<?php

namespace App\Http\Controllers\store;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $userId = Auth::user()->id;
            $wishlistItems = Wishlist::where('user_id', $userId)->with('product')->get()->pluck('product');
        } else {
            $productIds = session()->get('wishlist', []);
            $wishlistItems = product::whereIn('id',  $productIds)->get();
        }

        return view('store.wishlist', compact('wishlistItems'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);
        $productId = $request->product_id;
        $product = Product::where('id', $productId)->get();
        if (Auth::check()) {
            $user = Auth::user();
            $product = Wishlist::where('user_id', $user->id)
                ->where('product_id', $productId)->exists();
            if ($product) {
                return redirect()->back()->with('error', 'The product already in wishlist');
            } else {
                Wishlist::create([
                    'user_id' => $user->id,
                    'product_id' => $productId,
                ]);
                return redirect()->back()->with('success', 'the product has been added to wishlist');
            }
        } else {
            $wishlist = session()->get('wishlist', []);
            if (in_array($productId, $wishlist)) {
                return redirect()->back()->with('error', 'Product already in wishlist');
            }
            $wishlist[] = $productId;
            session()->put('wishlist', $wishlist);
            return redirect()->back()->with('success', 'Product added to wishlist');
        }
    }


    public function remove(string $productId)
    {

        if (Auth::check()) {
            $userId = Auth::user()->id;
            $wishlistItem =  Wishlist::where('user_id', $userId)->where('product_id', $productId)->first();
            if (! $wishlistItem) {
                return redirect()->back()->with('error', 'product is not in wishlist');
            } else {
                $wishlistItem->delete();
                return redirect()->back()->with('success', 'Product removed from wishlist');
            }
        } else {
            $wishlistItems = session()->get('wishlist', []);
            if (in_array($productId, $wishlistItems)) {
                $wishlistItems = array_values(array_diff($wishlistItems, [$productId]));
                session()->put('wishlist', $wishlistItems);
                return redirect()->back()->with('success', 'Product removed from wishlist');
            }
        }
    }

    public function clear()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $user->wishlists()->delete();
            return redirect()->route('wishlist')
                ->with('success', 'Wishlist cleared successfully');
        } else {
            $wishlistItems = session()->get('wishlist', []);
            session()->forget('wishlist');
            return redirect()->back()->with('success', 'Wishlist cleared successfully');
        }
    }
}
