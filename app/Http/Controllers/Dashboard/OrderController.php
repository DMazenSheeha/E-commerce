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
        $orders = Order::orderBy('id', 'DESC')->paginate(15);
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
            'name' => ['required', 'min:3', 'max:50'],
            'products' => 'required',
            'products.*' => 'exists:products,id',
            'user_id' => 'required|exists:users,id'
        ], [
            'name.required' => 'Order name is required',
            'name.min' => 'Order name must be 3 chars at least',
            'name.max' => 'Order name must be 50 chars at most',
            'products.required' => "Please choose products",
            'products.*.exists' => 'One or more selected products do not exist',
            'user_id.required' => 'User is required',
            'user_id.exists' => "User doesn't exist"
        ]);
        $order = new Order;
        $order->name = $request->name;
        $order->user_id = $request->user_id;
        $order->save();
        $order->products()->sync($request->products);
        return back()->with('success', 'Order Added successfully');
    }

    public function show()
    {
        return view("dashboard.orders.show");
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
            'name' => ['required', 'min:3', 'max:50'],
            'products' => 'required|array',
            'products.*' => 'exists:products,id',
            'user_id' => 'required|exists:users,id'
        ], [
            'name.required' => 'Order name is required',
            'name.min' => 'Order name must be 3 chars at least',
            'name.max' => 'Order name must be 50 chars at most',
            'products.required' => "Please choose products",
            'products.array' =>  "Products must be an array",
            'products.*.exists' => 'One or more selected products do not exist',
            'user_id.required' => 'User is required',
            'user_id.exists' => "User doesn't exist"
        ]);
        $order = Order::findOrFail($id);
        $order->name = $request->name;
        $order->user_id = $request->user_id;
        $order->save();
        $order->products()->sync($request->products);
        return back()->with('success', 'Order Updated successfully');
    }

    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return back()->with('success', 'Order deleted successfully');
    }
}
