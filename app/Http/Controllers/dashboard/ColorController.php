<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ColorController extends Controller
{

    public function index()
    {
        $colors = Color::all();
        return view('dashboard.colors.all-colors', compact('colors'));
    }

    public function create()
    {
        return view('dashboard.colors.add-color');
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|unique:colors,name|min:2|max:255',
            'hex_code' => 'required|unique:colors,hex_code',
        ]);
        Color::create($validatedData);
        return redirect()->back()->with('success', 'Color has been added successfully!');
    }

    public function edit(string $id)
    {
        $color = Color::findOrFail($id);
        return view('dashboard.colors.edit-color', compact('color'));
    }


    public function update(Request $request, string $id)
    {

        $color = Color::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'sometimes|required|unique:colors,name, '. $id,
            'hex_code' => 'sometimes|required|unique:colors,hex_code',
        ]);
        $color->update($validatedData);
        return redirect()->back()->with('success', 'Color has been updated successfully!');
    }
    public function destroy(string $id)
    {
        $color = Color::findOrFail($id);
        $color->delete();
        return redirect()->back()->with('success', 'color has been deleted successfully');
    }
}
