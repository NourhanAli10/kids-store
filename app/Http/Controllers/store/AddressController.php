<?php

namespace App\Http\Controllers\store;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $addresses = $user->addresses;
        return view('store.profile.addresses', compact('addresses'));
    }

    public function create(Request $request)
    {
        $user = Auth::user();
        return view('store.profile.add-address', compact('user'));
    }

    public function store(Request $request)
    {
        $ValidatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'phone'      => 'required|string|max:12',
            'address_type' => 'required|string|in:home,work,other',
            'address'    => 'required|string|max:500',
            'town'       => 'nullable|string|max:255',
            'city'       => 'required|string|max:255',
            'is_default' => 'nullable|boolean',
        ]);
        $ValidatedData['user_id'] = Auth::user()->id;
        $isDefault = $request->has('is_default') ? true : false;
        // If this is set as default, unset any previously default addresses
        if ($isDefault) {
            Address::where('user_id', Auth::user()->id)
                ->where('is_default', true)
                ->update(['is_default' => false]);
        }
        Address::create($ValidatedData);
        return redirect()->route('address.show')->with('message', 'address has been added');
    }


    public function edit($id)
    {
        $address =  Address::findOrFail($id);
        return view('store.profile.edit-address', compact('address'));
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'first_name' => 'sometimes|required|string|max:255',
            'last_name' => 'sometimes|required|string|max:255',
            'phone' => 'sometimes|required|string|max:20',
            'address_type' => 'sometimes|required|string|in:home,work,other',
            'address' => 'sometimes|required|string|max:255',
            'town' => 'sometimes|required|string|max:255',
            'city' => 'sometimes|required|string|max:255',
            'is_default' => 'nullable|boolean'
        ]);
        $user = Auth::user();
        $address = Address::where('id', $id)
            ->where('user_id', $user->id)
            ->firstOrFail();;
        if ($address->user_id !== $user->id) {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }

        $isDefault = $request->has('is_default') ? true : false;
        if ($isDefault && !$address->is_default) {
            Address::where('user_id', $user->id)
                ->where('is_default', true)
                ->update(['is_default' => false]);
        }

        $validatedData['is_default'] = $isDefault;
        $address->update($validatedData);
        return redirect()->back()->with('success', 'address has been updated');
    }
    
}
