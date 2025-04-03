<?php

namespace App\Http\Controllers\Front;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function index()
    {
        $userId = Auth::guard('web')->user()->id;
        $cartItems = Cart::with('product')->where('user_id', $userId)->get();
        $totalPrice = $cartItems->sum(function ($cartItem) {
            return $cartItem->product->price * $cartItem->quantity;
        });
        return view('front.cart', compact('cartItems', 'totalPrice'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'exists:users,id'],
            'action' => ['required', 'in:dec,inc,payload']
        ]);
        $userId = Auth::guard('web')->user()->id;
        $productInCart = Cart::where('product_id', $request->product_id)->where('user_id', $userId)->first();
        if ($request->action === 'payload') {
            if (!$request->payload) {
                return response()->json(['success' => false]);
            }
            if (!$productInCart) {
                $productInCart = new Cart;
                $productInCart->product_id = $request->product_id;
                $productInCart->user_id = $userId;
                $productInCart->quantity = $request->payload;
                $productInCart->save();
            }
            $productInCart->quantity = $request->payload;
            $productInCart->save();
        } elseif ($request->action === 'inc') {
            if ($productInCart) {
                $productInCart->quantity++;
                $productInCart->save();
            } else {
                $newProductInCart = new Cart;
                $newProductInCart->quantity = 1;
                $newProductInCart->product_id = $request->product_id;
                $newProductInCart->user_id = $userId;
                $newProductInCart->save();
            }
        } elseif ($request->action === 'dec') {
            $productInCart->quantity = $productInCart->quantity > 0 ? $productInCart->quantity - 1 : 0;
            $productInCart->save();
        } else {
            return response()->json(['success' => false, 'message' => 'Unknown action']);
        }
        return response()->json(['success' => true]);
    }

    public function destroy(string $id)
    {
        $cartItem = Cart::where('product_id', $id)->first();
        if ($cartItem) {
            $cartItem->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }
}
