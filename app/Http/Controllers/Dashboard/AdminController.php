<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::orderBy('id', 'DESC')->paginate(15);
        return view("dashboard.admins.index", compact('admins'));
    }

    public function create()
    {
        return view('dashboard.admins.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:3', 'max:20', 'string', 'unique:admins,name'],
            'email' => ['required', 'email', 'unique:users,email', 'regex:/@admin\.com$/', 'unique:admins,email'],
            'password' => ['required', 'min:6', 'max:20', 'confirmed'],
        ]);
        $admin = new Admin;
        $admin->name = $request->name;
        $admin->email = $request->email;
        if ($request->has('password') && $request->password != '') {
            $admin->password = bcrypt($request->password);
        }
        $admin->save();
        return back()->with('success', 'Admin added successfully');
    }

    public function edit(string $id)
    {
        $admin = Admin::findOrFail($id);
        return view('dashboard.admins.edit', compact('admin'));
    }

    public function update(Request $request, string $id)
    {
        $admin = Admin::findOrFail($id);
        $request->validate([
            'name' => ['required', 'min:3', 'max:20', 'string', 'unique:admins,name,' . $admin->id],
            'email' => ['required', 'email', 'regex:/@admin\.com$/', 'unique:users,email,' . $admin->id, 'unique:admins,email,' . $admin->id],
            'password' => ['nullable', 'string', 'min:6', 'max:30'],
            'password_confirmation' => ['nullable', 'string', 'same:password'],
        ]);
        $admin->name = $request->name;
        $admin->email = $request->email;
        if ($request->has('password') && $request->password != '') {
            $admin->password = bcrypt($request->password);
        }
        $admin->save();
        if ($admin->wasChanged()) {
            return back()->with('success', 'Admin updated successfully');
        }

        return back();
    }

    public function show(string $id)
    {
        $admin = Admin::findOrFail($id);
        return view('dashboard.admins.show', compact('admin'));
    }

    public function destroy(string $id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();
        return back()->with("success", 'Admin deleted successfully');
    }
}
