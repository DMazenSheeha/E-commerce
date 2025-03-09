<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
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
        $data = $request->validate([
            'name' => ['required', 'string', 'min:3', 'unique:categories,name'],
        ], [
            'name.required' => 'Category name is required',
            'name.string' => 'Please write a valid category name',
            'name.min' => 'Category name must be 3 chars at least',
        ]);
        Category::create($data);
        return back()->with('success', 'Category added succefully');
    }

    public function show(string $id)
    {
        return view('dashboard.categories.show');
    }

    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('dashboard.categories.edit', compact('category'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'unique:categories,name'],
        ], [
            'name.required' => 'Category name is required',
            'name.string' => 'Please write a valid category name',
            'name.min' => 'Category name must be 3 chars at least',
        ]);
        $category = Category::findOrFail($id);
        $category->name = $request->name;
        if (!$category->isDirty()) {
            return back();
        }
        return back()->with('success', 'Category updated succefully');
    }

    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return back()->with('success', 'Category deleted successfully');
    }
}
