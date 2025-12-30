<?php

namespace App\Http\Controllers\store;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProfileController extends Controller
{

    public function index(): View
    {
        $user = Auth::user();
        $orders = $user->orders;
        $address =  $user->addresses;
        return view('store.profile.my-account', compact('user', 'orders', 'address'));
    }


    public function show() {
        $user = Auth::user();
        return view('store.profile.my-profile' , compact('user'));
    }
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        // return view('profile.edit', [
        //     'user' => $request->user(),
        // ]);
        return view('store.profile.edit-profile');
    }

    /**
     * Update the user's profile information.
     */
    //
    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'first_name' => ['sometimes','required', 'string', 'min:3', 'max:225'],
            'last_name' => ['sometimes', 'required', 'string', 'min:3', 'max:225'],
            'email' => ['sometimes', 'required', 'email', 'lowercase', 'max:225',
            Rule::unique(User::class)->ignore(auth()->user()->id)],
            'phone' => ['sometimes', 'required', 'string'],
        ]);

        $request->user()->fill($data);

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile updated successfully');
    }

    public function changePassword(Request $request) {
        $request->validate([
        'current_password' => ['required', 'current_password'],
        'password' => ['required', 'string', 'regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/', 'confirmed'],
        ]);
        if(Hash::check($request->password, $request->user()->password)) {
            return back()->withErrors([
                'password' => 'New password cannot be the same as your current password.'
            ]);
        } else {
            $request->user()->update([
                'password' => $request->password,
            ]);
            return Redirect::route('profile.edit')->with('status', 'password updated successfully');
        }
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
