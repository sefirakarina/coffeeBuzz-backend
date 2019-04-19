<?php

namespace App\Http\Controllers;

use App\Cart;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function showAllCarts() {
        return Cart::all();
    }

    public function showCartById($id) {
        return Cart::find($id);
    }

    public function deleteCart($id) {
        Cart::where('id', $id)->delete();
    }

    public function addCart(Request $request) {
        $cart = new Cart;
        $cart->user_id = $request->user_id;
        $cart->save();
    }

    public function updateCart(Request $request, $id) {
        $cart = Cart::find($id);
        $cart->user_id = $request->input('user_id');
        $cart->save();
    }
}
