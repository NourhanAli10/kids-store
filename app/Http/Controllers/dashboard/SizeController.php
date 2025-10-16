<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SizeController extends Controller
{
    public function index(){
        $sizes = Size::all();
        return view('dashboard.size.all-sizes', compact('sizes'));
    }

    public function create() {
        return view('dashboard.size.add-size');
    }

    public function store(Request $request) {

        $ValidatedData = $request->validate([
            'name' => 'required|unique:sizes,name',
        ]);

        Size::create($ValidatedData);
        return redirect()->back()->with('success', 'Size has been added successfully!');

    }

    public function edit(string $id) {
        $size = Size::findOrFail($id);
        return view('dashboard.size.edit-size', compact('size'));
    }


    public function update(Request $request, string $id) {

        $size = Size::findOrFail($id);

        $ValidatedData = $request->validate([
            'name' => 'required|unique:sizes,name,' . $id,
        ]);
        $size->update($ValidatedData);
        return redirect()->back()->with('success', 'size has been updated successfully');

    }
    public function destroy(string $id) {
        $size = Size::findOrFail($id);
        $size->delete();
        return redirect()->back()->with('success', 'size has been deleted successfully');
    }
}
