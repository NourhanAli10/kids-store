<?php

namespace App\Http\Controllers\dashboard;

use App\Services\Media;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class CategoryController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('created_at', 'desc')->get();
        return view('dashboard.category.all', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('dashboard.category.add');
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
        $image= $media->UploadMedia($request->file('image'), 'categories');
        $data['image'] = $image;
        $data['slug'] = Str::slug($request->input('name'), '-');
        $data['created_by'] = Auth::user()->first_name;
        Category::create($data);
        return redirect()->back()->with('success', 'Category added successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findorFail($id);
        return view('dashboard.category.edit', compact( 'category'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::findorFail($id);

        $request->validate([
            'name' => 'required|min:2|max:255',
            'status' => 'required|in:available,unavailable',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except('_token', '_method');
        $data['slug'] = Str::slug($request->input('name'), '-');
        $data['created_by'] = Auth::user()->first_name;
        if ($request->file('image'))
        {
            $media = new Media;
            $NewImageName = $media->UploadMedia($request->file('image'), 'categories');
            $data['image'] = $NewImageName;
            $media->deleteMedia($category->image, 'categories');
        };
        $category->update($data);
        return redirect()->route('admin.categories')->with('success', 'Category Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findorFail($id);
        $category->delete();
        return redirect()->back()->with( 'success','Category deleted Successfully!');
    }
}
