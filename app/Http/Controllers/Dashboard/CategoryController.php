<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use File;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('id', 'DESC')->paginate(15);
        return view("dashboard.categories.index", compact('categories'));
    }

    public function products(string $id)
    {
        $products = Product::where("category_id", $id)->paginate(15);
        return view('dashboard.products.index', compact('products'));
    }

    public function create()
    {
        return view('dashboard.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'unique:categories,name'],
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png']
        ], [
            'name.required' => 'Category name is required',
            'name.string' => 'Please write a valid category name',
            'name.min' => 'Category name must be 3 chars at least',
        ]);
        $image = $request->file('image')->store('public');
        $category = new Category;
        $category->name = $request->name;
        $category->image = $image;
        $category->save();
        return back()->with('success', 'Category added succefully');
    }

    public function show(string $id)
    {
        $category = Category::findOrFail($id);
        return view('dashboard.categories.show', compact('category'));
    }

    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('dashboard.categories.edit', compact('category'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'unique:categories,name,' . $id],
            'image' => ['required', 'image', 'mimes:jpg,png,jpeg']
        ], [
            'name.required' => 'Category name is required',
            'name.string' => 'Please write a valid category name',
            'name.min' => 'Category name must be 3 chars at least',
        ]);
        $category = Category::findOrFail($id);
        File::delete($category->image);
        $image = $request->file('image')->store('public');
        $category->name = $request->name;
        $category->image = $image;
        $category->save();
        if ($category->wasChanged()) {
            return back()->with('success', 'Category updated succefully');
        }
        return back();
    }

    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        File::delete($category->image);
        return back()->with('success', 'Category deleted successfully');
    }
}
