<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        $recentProducts = Product::orderBy('DESC')->paginate(8);
        return view('front.index', compact('recentProducts'));
    }
    public function shop()
    {
        $products = Product::orderBy('DESC')->paginate(9);
        return view('front.shop', compact('products'));
    }
    public function contact()
    {
        return view('front.contact');
    }
}
