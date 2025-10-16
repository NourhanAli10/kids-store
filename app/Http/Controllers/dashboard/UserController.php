<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\dashboard\RegisterRequest;
use App\Http\Requests\Auth\dashboard\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index() {
        $users = User::all();
        return view('dashboard.users.all-users', compact('users'));
    }

    public function create() {
        return view('dashboard.users.create-user');
    }


    public function store(RegisterRequest $request) {
        $data = $request->validated();
        User::create($data);
        return redirect()->back()->with('success', 'User created successfully');
    }

    public function edit(string $id) {
        $user = User::find($id);
        return view('dashboard.users.edit-user', compact('user'));
    }

    public function update(UpdateUserRequest $request, string $id) {
        $user = User::find($id);
        $data = $request->validated();
        $user->update($data);
        return redirect()->back()->with('success', 'User updated successfully');
    }

    public function destroy(string $id) {
        $user = User::find($id);
        $user->delete();
        return redirect()->back()->with('success', 'User deleted successfully');
    }
}
