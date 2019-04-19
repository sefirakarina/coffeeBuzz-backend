<?php

namespace App\Http\Controllers;

use App\Food;

use Illuminate\Http\Request;

class FoodController extends Controller
{
    //not tested

    protected $food;
    public function __construct(Food $food){
        $this->middleware('auth:api', ['except' => ['index']]);
        $this->food = $food;
    }

    public function add(Request $request){
        $newFood = [
            'name' => $request->name,
            'drink_type' => $request->qty
        ];

        if($newFood!=null){
            $new = $this->books->create($newFood);
            $array = Array();
            $array['data'] = $new;
            return response()->json($array,200);
        } else {
            return response()->json(['error' => 'food not added'], 404);
        }
    }
}
