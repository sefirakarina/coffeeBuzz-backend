<?php

namespace App\Http\Controllers;

use App\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    public function showAllFoods() {
        return Food::all();
    }

    public function showFoodById($id) {
        return Food::find($id);
    }

    public function deleteFood($id) {
        Food::where('id', $id)->delete();
    }

    public function addFood(Request $request) {
        $cart = new Food;
        $cart->name = $request->name;
        $cart->qty = $request->qty;
        $cart->save();
    }

    public function updateFood(Request $request, $id) {
        $cart = Food::find($id);
        $cart->name = $request->input('name');
        $cart->qty = $request->input('qty');
        $cart->save();
    }
}
