<?php

namespace App\Http\Controllers;

use App\Item;

use Illuminate\Http\Request;

class ItemController extends Controller
{
    protected $item;

    public function __construct(Item $item)
    {
        $this->middleware('auth:api');
        $this->item = $item;
    }

    public function index() {
        $item = Item::all();
        $array = Array();
        $array['data'] = $item;
        if (count($item) > 0) {
            return response()->json($array, 200);
        } else {
            return response()->json(['error' => 'Item not found'], 404);
        }
    }

    public function show($id) {
        $item =  Item::find($id);
        $array = Array();
        $array['data'] = $item;
        if (count($item) > 0) {
            return response()->json($array, 200);
        } else {
            return response()->json(['error' => 'Item not found'], 404);
        }
    }

    public function destroy($id) {
        $item = Item::where('id', $id)->delete();
        if ($item != null) {
            return response()->json($item, 200);
        } else {
            return response()->json(['error' => 'Item cannot be deleted'], 404);
        }
    }

    public function store(Request $request) {
        $newItem = [
            'item_type' => $request->item_type,
            'food_id' => $request->food_id,
            'drink_id' => $request->drink_id,
        ];

        if ($newItem != null) {
            $new = $this->item->create($newItem);
            $array = Array();
            $array['data'] = $new;
            return response()->json($array, 200);
        } else {
            return response()->json(['error' => 'Item not added'], 404);
        }
    }

    public function updateItem(Request $request, $id) {
        $item = Item::where('id', $request->id)->update([
            'item_type' => $request->item_type,
            'food_id' => $request->food_id,
            'drink_id' => $request->drink_id,
        ]);
        if($item!=null){
            return response()->json($item, 200);
        } else {
            return response()->json(['error' => 'Item not updated'], 404);
        }
    }
}
