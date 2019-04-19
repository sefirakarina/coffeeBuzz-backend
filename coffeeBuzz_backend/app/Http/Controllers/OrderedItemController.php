<?php

namespace App\Http\Controllers;

use App\OrderedItem;

use Illuminate\Http\Request;

class OrderedItemController extends Controller
{
    public function showAllOrderedItems() {
        return OrderedItem::all();
    }

    public function showOrderedItemById($id) {
        return OrderedItem::find($id);
    }

    public function deleteOrderedItem($id) {
        OrderedItem::where('id', $id)->delete();
    }

    public function addOrderedItem(Request $request) {
        $cart = new OrderedItem;
        $cart->cart_id = $request->cart_id;
        $cart->save();
    }

    public function updateOrderedItem(Request $request, $id) {
        $cart = OrderedItem::find($id);
        $cart->cart_id = $request->input('cart_id');
        $cart->save();
    }
}