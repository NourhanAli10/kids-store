<?php

namespace App\Http\Controllers\store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index() {

    }


    public function store(Request $request) {
        $validatedData = $request->validate([
            'product_id' => 'required|exists:Products,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|min:10|max:1000',
        ]);
        $validatedData['user_id'] =  Auth::user()->id;


    }
}
