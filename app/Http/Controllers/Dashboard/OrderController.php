<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('products')->where('status', 'pending')->orderBy('id', 'DESC')->paginate(15);
        return view("dashboard.orders.index", compact('orders'));
    }

    public function create()
    {
        $products = Product::select('id', 'name')->get();
        $categories = Category::select('id', 'name')->get();
        $users = User::select("id", 'name')->get();
        return view("dashboard.orders.create", compact('categories', 'products', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'products' => 'required',
            'products.*' => 'exists:products,id',
            'user_id' => 'required|exists:users,id',
            'user_mobile_number' => 'required|regex:/^01[0-9]{9}$/',
            'address' => 'required|min:3|max:100',
            'city' => 'required|min:5|max:100'
        ], [
            'products.required' => "Please choose products",
            'products.*.exists' => 'One or more selected products do not exist',
            'user_id.required' => 'User is required',
            'user_id.exists' => "User doesn't exist",
            'user_mobile_number.required' => 'Mobile number is required',
            'user_mobile_number.regex' => 'Mobile number is invalid'
        ]);
        $order = new Order;
        $order->user_id = $request->user_id;
        $order->user_mobile_number = $request->user_mobile_number;
        $order->city = $request->city;
        $order->address = $request->address;
        $order->status = "pending";
        $order->save();
        $order->products()->sync($request->products);
        return back()->with('success', 'Order Added successfully');
    }

    public function show(string $id)
    {
        $order = Order::findOrFail($id);
        $totalPrice = $order->products()->sum('price');
        return view("dashboard.orders.show", compact('order', 'totalPrice'));
    }

    public function edit(string $id)
    {
        $order = Order::findOrFail($id);
        $products = Product::select('id', 'name')->get();
        $categories = Category::select('id', 'name')->get();
        $users = User::select("id", 'name')->get();
        return view('dashboard.orders.edit', compact('categories', 'order', 'products', 'users'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'products' => 'required|array',
            'products.*' => 'exists:products,id',
            'user_id' => 'required|exists:users,id',
            'user_mobile_number' => 'required|regex:/^01[0-9]{9}$/',
            'address' => 'required|min:3|max:100',
            'city' => 'required|min:5|max:100'
        ], [
            'products.required' => "Please choose products",
            'products.array' =>  "Products must be an array",
            'products.*.exists' => 'One or more selected products do not exist',
            'user_id.required' => 'User is required',
            'user_id.exists' => "User doesn't exist",
            'user_mobile_number.required' => 'Mobile number is required',
            'user_mobile_number.regex' => 'Mobile number is invalid'
        ]);
        $order = Order::findOrFail($id);
        $oldProducts = $order->products->pluck('id')->sort()->values()->toArray();
        $newProducts = collect($request->products)->sort()->values()->toArray();
        $order->user_id = $request->user_id;
        $order->user_mobile_number = $request->user_mobile_number;
        $order->city = $request->city;
        $order->address = $request->address;
        $order->status = "pending";
        $order->save();
        $order->products()->sync($request->products);
        if ($order->wasChanged() || $oldProducts != $newProducts) {
            return back()->with('success', 'Order Updated successfully');
        }
        return back();
    }

    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return back()->with('success', 'Order deleted successfully');
    }

    public function ordersInfo()
    {
        $orders = Order::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('year', 'month')
            ->orderBy('year', 'DESC')
            ->orderBy('month', 'ASC')
            ->paginate(2);
        return response()->json($orders);
    }

    public function changeStatusToDone(string $id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'done';
        $order->save();
        return back()->with('success', 'Order have been done successfully');
    }
}
