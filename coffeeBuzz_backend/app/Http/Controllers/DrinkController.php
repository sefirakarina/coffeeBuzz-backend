<?php

namespace App\Http\Controllers;

use App\Drink;

use Illuminate\Http\Request;

class DrinkController extends Controller
{
    public function showAllDrinks() {
        return Drink::all();
    }

    public function showDrinkById($id) {
        return Drink::find($id);
    }

    public function deleteDrink($id) {
        Drink::where('id', $id)->delete();
    }

    public function addDrink(Request $request) {
        $cart = new Drink;
        $cart->name = $request->name;
        $cart->drink_type = $request->drink_type;
        $cart->save();
    }

    public function updateDrink(Request $request, $id) {
        $cart = Drink::find($id);
        $cart->name = $request->input('name');
        $cart->drink_type = $request->input('drink_type');
        $cart->save();
    }
}
