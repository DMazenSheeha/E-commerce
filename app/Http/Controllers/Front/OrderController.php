<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function index()
    {
        $userId = Auth::guard('web')->user()->id;
        $orders = Order::where('user_id', $userId)->with('products')->orderBy('id', 'DESC')->get()->map(function ($order) {
            $order->total_price = $order->products->sum('price');
            return $order;
        });
        return view('front.orders.index', compact('orders'));
    }

    public function create()
    {
        $userId = Auth::guard('web')->user()->id;
        $cartItems = Cart::where('user_id', $userId)->with('product')->get();
        $totalPrice = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
        return view('front.orders.create', compact('cartItems', 'totalPrice'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'city' => 'required|string|min:3|max:50',
            'address' => 'required|string|min:5|max:100',
            'user_mobile_number' => 'required|regex:/^01[0-9]{9}$/'
        ]);
        $userId = Auth::guard('web')->user()->id;
        $cartItems = Cart::with('product')->where('user_id', $userId)->get();
        if ($cartItems->count() > 0) {
            $products = $cartItems->map(function ($item) {
                return $item->product;
            });
            $newOrder = new Order;
            $newOrder->user_id = $userId;
            $newOrder->city = $request->city;
            $newOrder->address = $request->address;
            $newOrder->user_mobile_number = $request->user_mobile_number;
            $newOrder->status = 'pending';
            $newOrder->save();
            $newOrder->products()->sync($products);
            $cartItems->map(function ($item) {
                $item->delete();
            });
            return to_route('shop.index')->with('success', 'Your Order have been delivered');
        }
        return back();
    }
}
