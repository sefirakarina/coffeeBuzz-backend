<?php

namespace App\Http\Controllers;

use App\Order_list;

use App\OrderList;
use Illuminate\Http\Request;

class OrderListController extends Controller
{
    public function showAllOrderLists() {
        return OrderList::all();
    }

    public function showOrderListById($id) {
        return OrderList::find($id);
    }

    public function deleteOrderList($id) {
        OrderList::where('id', $id)->delete();
    }

    public function addOrderList(Request $request) {
        $cart = new OrderList;
        $cart->cart_id = $request->cart_id;
        $cart->item_id = $request->item_id;
        $cart->qty = $request->qty;
        $cart->save();
    }

    public function updateOrderList(Request $request, $id) {
        $cart = OrderList::find($id);
        $cart->cart_id = $request->input('cart_id');
        $cart->item_id = $request->input('item_id');
        $cart->qty = $request->input('qty');
        $cart->save();
    }
}
