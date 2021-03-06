<?php

namespace App\Http\Controllers;

use App\Drink;

use Illuminate\Http\Request;

class DrinkController extends Controller
{
    protected $drink;

    public function __construct(Drink $drink)
    {
        $this->middleware('auth:api', ['except' => ['index']]);
        $this->drink = $drink;
    }

    public function index()
    {
        $drink = Drink::with('drinkName')->with('drinkSize')->get();
        $array = Array();
        $array['data'] = $drink;
        if (sizeof($array) > 0) {
            return response()->json($array, 200);
        } else {
            return response()->json(['error' => 'Drink not found'], 404);
        }
    }

    public function show($id)
    {
        $drink = Drink::find($id);
        $array = Array();
        $array['data'] = $drink;
        if (count($array) > 0) {
            return response()->json($array, 200);
        } else {
            return response()->json(['error' => 'Drink not found'], 404);
        }
    }

    public function destroy($id)
    {
        $drink = Drink::where('id', $id)->delete();
        if ($drink != null) {
            return response()->json($drink, 200);
        } else {
            return response()->json(['error' => 'Drink cannot be deleted'], 404);
        }
    }

    public function store(Request $request)
    {
        $newDrink = [
            'price' => $request->price,
            'size_id' => $request->sizeId,
            'name_id' => $request->nameId
        ];

        if ($newDrink != null) {
            $new = $this->drink->create($newDrink);
            $array = Array();
            $array['data'] = $new;
            return response()->json($array, 200);
        } else {
            return response()->json(['error' => 'Drink not added'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $drink = Drink::where('id', $id)->update([
            'price' => $request->price,
            'size_id' => $request->sizeId,
            'name_id' => $request->nameId
        ]);
        if ($drink != null) {
            return response()->json($drink, 200);
        } else {
            return response()->json(['error' => 'Drink not updated'], 404);
        }
    }
}
