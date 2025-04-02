<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id', 'DESC')->paginate(9);
        return view('front.shop.index', compact('products'));
    }

    public function productsByCategory(string $categoryId)
    {
        $products = Product::where('category_id', $categoryId)->paginate(8);
        return view('front.shop.index', compact('products'));
    }

    public function productsByName(Request $request)
    {
        if (strlen($request->q) > 0) {
            $products = Product::where('name', 'LIKE', '%' . $request->q . '%')->paginate(8)->withQueryString();
            return view('front.shop.index', compact('products'));
        } else {
            return back();
        }
    }

    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return view('front.shop.show', compact('product'));
    }
}
