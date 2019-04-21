<?php

namespace App\Http\Controllers;

use App\Cart;

use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cart;

    public function __construct(Cart $cart)
    {
        $this->middleware('auth:api');
        $this->cart = $cart;
    }

    public function index()
    {
        $cart = Cart::all();
        $array = Array();
        $array['data'] = $cart;
        if (count($cart) > 0) {
            return response()->json($array, 200);
        } else {
            return response()->json(['error' => 'Cart not found'], 404);
        }
    }

    public function show($id)
    {
        $cart = Cart::find($id);
        $array = Array();
        $array['data'] = $cart;
        if (count($cart) > 0) {
            return response()->json($array, 200);
        } else {
            return response()->json(['error' => 'Cart not found'], 404);
        }
    }

    public function destroy($id, Request $request)
    {
        $cart = Cart::where('id', $id)->delete();
        if ($cart != null) {
            return response()->json($cart, 200);
        } else {
            return response()->json(['error' => 'Cart cannot be deleted'], 404);
        }
    }

    public function store(Request $request)
    {
        $newCart = [
            'user_id' => $request->user_id,
        ];

        if ($newCart != null) {
            $new = $this->cart->create($newCart);
            $array = Array();
            $array['data'] = $new;
            return response()->json($array, 200);
        } else {
            return response()->json(['error' => 'Cart not added'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $cart = Cart::where('id', $request->id)->update([
            'user_id' => $request->user_id,
        ]);
        if ($cart != null) {
            return response()->json($cart, 200);
        } else {
            return response()->json(['error' => 'Cart not updated'], 404);
        }
    }
}
