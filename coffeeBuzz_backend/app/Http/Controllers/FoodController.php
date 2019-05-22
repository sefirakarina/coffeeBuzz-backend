<?php

namespace App\Http\Controllers;

use App\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    protected $food;

    public function __construct(Food $food)
    {
        $this->middleware('auth:api', ['except' => ['index']]);
        $this->food = $food;
    }

    public function index()
    {
        $food = Food::all();
        $array = Array();
        $array['data'] = $food;
        if (count($food) > 0) {
            return response()->json($array, 200);
        } else {
            return response()->json(['error' => 'Food not found'], 404);
        }
    }

    public function show($id)
    {
        $food = Food::find($id);
        $array = Array();
        $array['data'] = $food;
        if (sizeof($array) > 0) {
            return response()->json($array, 200);
        } else {
            return response()->json(['error' => 'Food not found'], 404);
        }
    }

    public function destroy($id)
    {
        $food = Food::where('id', $id)->delete();
        if ($food != null) {
            return response()->json($food, 200);
        } else {
            return response()->json(['error' => 'Food cannot be deleted'], 404);
        }
    }

    public function store(Request $request)
    {
        $newFood = [
            'name' => $request->name,
            'qty' => $request->qty,
            'price' => $request->price,
        ];

        if ($newFood != null) {
            $new = $this->food->create($newFood);
            $array = Array();
            $array['data'] = $new;
            return response()->json($array, 200);
        } else {
            return response()->json(['error' => 'Food not added'], 404);
        }
    }

    public function update(Request $request, $food)
    {
        $new_food = Food::where('id', $food)->update([
            'name' => $request->name,
            'qty' => $request->qty,
            'price' => $request->price,
        ]);
        if ($new_food != null) {
            return response()->json($new_food, 200);
        } else {
            return response()->json(['error' => 'Food not updated'], 404);
        }
    }
}
