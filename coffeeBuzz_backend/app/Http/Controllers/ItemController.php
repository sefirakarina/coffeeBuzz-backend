<?php

namespace App\Http\Controllers;

use App\Item;

use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function showAllItems() {
        return Item::all();
    }

    public function showItemById($id) {
        return Item::find($id);
    }

    public function deleteItem($id) {
        Item::where('id', $id)->delete();
    }

    public function addItem(Request $request) {
        $cart = new Item;
        $cart->item_type = $request->item_type;
        $cart->food_id = $request->food_id;
        $cart->drink_id = $request->drink_id;
        $cart->save();
    }

    public function updateItem(Request $request, $id) {
        $cart = Item::find($id);
        $cart->item_type = $request->input('item_type');
        $cart->food_id = $request->input('food_id');
        $cart->drink_id = $request->input('drink_id');
        $cart->save();
    }
}
