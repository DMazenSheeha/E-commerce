<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('id', 'DESC')->paginate(15);
        return view("dashboard.orders.index", compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view("dashboard.orders.create", compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:3', 'max:50'],
            'products' => 'required',
            'products*' => 'exists:products,id'
        ], [
            'name.required' => 'Order name is required',
            'name.min' => 'Order name must be 3 chars at least',
            'name.max' => 'Order name must be 50 chars at most',
            'products.required' => "Please choose products",
            'products.exists' => 'One or more selected products do not exist'
        ]);
        $order = new Order;
        $order->name = $request->name;
        $order->user_id = 1;
        $order->save();
        $order->products()->sync($request->products);
        return back()->with('success', 'Order Added successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function show()
    {
        return view("dashboard.orders.show");
    }

    public function edit(string $id)
    {
        $order = Order::findOrFail($id);
        $categories = Category::all();
        return view('dashboard.orders.edit', compact('categories', 'order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return back()->with('success', 'Order deleted successfully');
    }
}
