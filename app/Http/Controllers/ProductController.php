<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id', 'DESC')->paginate(15);
        return view("dashboard.products.index", compact('products'));
    }

    public function searchByCategories(string $id)
    {
        $products = Product::where('category_id', $id)->get();
        return response()->json(compact('products'));
    }

    public function searchByName(Request $request)
    {
        $products = Product::where("name", 'LIKE', '%' . $request->q . "%")->paginate(15)->withQueryString();
        if (strlen($request->q) > 0) {
            return view('dashboard.products.index', compact('products'));
        } else {
            return back();
        }
    }

    public function create()
    {
        $categories = Category::all();
        return view("dashboard.products.create", compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3'],
            'price' => 'required',
            'category_id' => ['required', 'exists:categories,id'],
            'desc' => ['required', 'max:1000']
        ], [
            'name.required' => 'Product name is required',
            'name.string' => 'Please write a valid product name',
            'name.min' => 'Product name must be more than 2 chars',
            'desc.required' => 'Product description is required',
            'desc.max' => "You can't write more than 1000 chars",
            'price.required' => "Product price is required",
            'category.required' => 'Product category is required'
        ]);
        $product = new Product;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->desc = $request->desc;
        $product->save();
        return back()->with('success', "Product added successfully");
    }

    public function show(string $id)
    {
        return view("dashboard.products.show");
    }

    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view("products.edit", compact('categories', 'product'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3'],
            'price' => 'required',
            'category_id' => ['required', 'exists:categories,id'],
            'desc' => ['required', 'max:1000']
        ], [
            'name.required' => 'Product name is required',
            'name.string' => 'Please write a valid product name',
            'name.min' => 'Product name must be more than 2 chars',
            'desc.required' => 'Product description is required',
            'desc.max' => "You can't write more than 1000 chars",
            'price.required' => "Product price is required",
            'category.required' => 'Product category is required'
        ]);
        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->desc = $request->desc;
        $product->save();
        if (!$product->isDirty()) {
            return back();
        }
        return back()->with('success', "Product updated successfully");
    }

    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return back()->with('success', "Product deleted successfully");
    }
}
