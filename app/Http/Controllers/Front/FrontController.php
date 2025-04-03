<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;

class FrontController extends Controller
{
    public function index()
    {
        $recentProducts = Product::orderBy('id', 'DESC')->paginate(8);
        return view('front.index', compact('recentProducts'));
    }

    public function contact()
    {
        return view('front.contact');
    }
}
