<?php

namespace App\Http\Controllers\store;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|min:3|max:1000',
        ]);
        $user = Auth::user();
        $validatedData['user_id'] =  $user->id;
        $hasPurchased = $user->orders()
            ->where('status', 'delivered')
            ->whereHas('orderItems', function ($query) use ($request) {
                $query->where('product_id', $request->product_id);
            })->exists();
        if (!$hasPurchased) {
            return redirect()->back()->with('error', 'You must purchase this product before reviewing it');
        }

        $review = $user->hasReview($request->product_id);
        if ($review) {
            return redirect()->back()->with('error', 'You have already reviewed that product');
        }
        Review::create($validatedData);
        return redirect()->back()->with('success', 'Review submitted successfully!');
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'comment' => 'nullable|string|max:1000',
            'rating' => 'required|integer|min:1|max:5',
        ]);
        $review = Review::findOrFail($id);
        if ($review->user_id !== auth()->id()) {
            return back()->with('error', 'You are not allowed to edit this review.');
        }
        $review->update([
            'comment' =>  $validated['comment'],
            'rating' => $validated['rating'] ?? $review->rating
        ]);

        return redirect()->back()->with('success', 'Review updated successfully.');
    }


    public function destroy(string $id)
    {
        $review = Review::findOrfail($id);
        $user = Auth::user();
        if ($review->user_id != $user->id && !$user->hasRole('admin')) {
            return redirect()->back()->with('error', 'You can only delete your own reviews');
        }
        $review->delete();
        return redirect()->back()->with('success', "Your review has been deleted");
    }
}
