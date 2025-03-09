<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        $users = User::orderBy('id', 'DESC')->paginate(15);
        return view("dashboard.users.index", compact('users'));
    }

    public function create()
    {
        return view('dashboard.users.create');
    }

    public function show()
    {
        return view('dashboard.users.show');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'min:3', 'max:20', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:6', 'max:20', 'confirmed'],
        ]);
        User::create($data);
        return back()->with('success', 'User added successfully');
    }

    public function orders(string $id)
    {
        $orders = Order::where('user_id', $id)->paginate(15);
        return view('dashboard.orders.index', compact('orders'));
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return back()->with('success', 'User deleted successfully');
    }
}
