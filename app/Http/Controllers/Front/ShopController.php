<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $priceOptions = array_filter($request->query(), function ($key) {
            return strpos($key, 'price-option-') === 0;
        }, ARRAY_FILTER_USE_KEY);
        $query = Product::query();
        if ($request->sorting && $request->sorting == 'best-selling') {
            $query->withCount('orders')->orderBy('orders_count', 'DESC');
        } else {
            $query->orderBy('id', 'DESC');
        }
        if (count($priceOptions) > 0 && !$request->query('price-option-1')) {
            $query->where(function ($q) use ($priceOptions) {
                foreach ($priceOptions as $option) {
                    $q->orWhereBetween('price', [(int)$option - 100, (int)$option]);
                }
            });
        }

        if ($request->query("cat")) {
            $query->where('category_id', $request->query('cat'));
        }

        $products = $query->paginate(9)->withQueryString();

        return view('front.shop.index', compact('products'));
    }


    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return view('front.shop.show', compact('product'));
    }

    public function productsByCategory(string $categoryId)
    {
        $products = Product::where('category_id', $categoryId)->paginate(8)->withQueryString();
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
}
