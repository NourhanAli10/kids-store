<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Services\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::orderby('created_at', 'DESC')->get();
        return view('dashboard.brands.all', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.brands.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|min:2|max:255',
            'status' => 'required|in:available,unavailable',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except('_token', 'image');

        $media = new Media;

        $image = $media->UploadMedia($request->file('image'), 'brands');

        $data['image'] = $image;

        $data['slug'] = Str::slug($request->input('name'), '_');

        $data['created_by'] = Auth::user()->first_name;

        Brand::create($data);

        return redirect()->back()->with('success', 'Brand added successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $brand  = Brand::findOrFail($id);
        return view('dashboard.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $brand = Brand::findOrFail($id);
        $request->validate([
            'name' => 'required|unique:categories|min:4|max:255',
            'status' => 'required|in:available,unavailable',
            'image' => 'nullable','mimes:png,jpeg,jpg','max:2028',
        ]);

        $data = $request->except('image', '_token', '_method');

        if ($request->file('image'))
        {
            $media = new Media;
            $NewImageName = $media->UploadMedia($request->file('image'), 'brands');
            $data['image'] = $NewImageName;
            $media->deleteMedia($brand->image, 'brands');
        };
        $brand->update($data);
        return redirect()->back()->with('success', 'brand has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::findorFail($id);
        $media = new Media;
        $media->deleteMedia($brand->image, 'brands');
        $brand->delete();
        return redirect()->back()->with('success', 'brand has been deleted successfully');
    }
}
