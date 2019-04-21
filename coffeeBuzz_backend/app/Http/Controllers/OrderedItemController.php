<?php

namespace App\Http\Controllers;

use App\OrderedItem;

use Illuminate\Http\Request;

class OrderedItemController extends Controller
{
    protected $ordered_item;

    public function __construct(OrderedItem $ordered_item)
    {
        $this->middleware('auth:api');
        $this->ordered_item = $ordered_item;
    }

    public function index()
    {
        $ordered_item = OrderedItem::all();
        $array = Array();
        $array['data'] = $ordered_item;
        if (count($ordered_item) > 0) {
            return response()->json($array, 200);
        } else {
            return response()->json(['error' => 'Ordered items not found'], 404);
        }
    }

    public function show($id)
    {
        $ordered_item = OrderedItem::find($id);
        $array = Array();
        $array['data'] = $ordered_item;
        if (count($ordered_item) > 0) {
            return response()->json($array, 200);
        } else {
            return response()->json(['error' => 'Ordered items not found'], 404);
        }
    }

    public function destroy($id)
    {
        $ordered_item = OrderedItem::where('id', $id)->delete();
        if ($ordered_item != null) {
            return response()->json($ordered_item, 200);
        } else {
            return response()->json(['error' => 'Ordered item cannot be deleted'], 404);
        }
    }

    public function store(Request $request)
    {
        $newOrderedItem = [
            'cart_id' => $request->cart_id,
        ];

        if ($newOrderedItem != null) {
            $new = $this->ordered_item->create($newOrderedItem);
            $array = Array();
            $array['data'] = $new;
            return response()->json($array, 200);
        } else {
            return response()->json(['error' => 'Ordered item not added'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $ordered_item = OrderedItem::where('id', $request->id)->update([
            'cart_id' => $request->cart_id,
        ]);
        if ($ordered_item != null) {
            return response()->json($ordered_item, 200);
        } else {
            return response()->json(['error' => 'Ordered item not updated'], 404);
        }
    }
}