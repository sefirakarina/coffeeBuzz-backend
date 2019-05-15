<?php

namespace App\Http\Controllers;

use App\OrderList;
use Illuminate\Http\Request;

class OrderListController extends Controller
{
    protected $order_list;

    public function __construct(OrderList $order_list)
    {
        $this->middleware('auth:api');
        $this->order_list = $order_list;
    }

    public function index() {
        $order_list = OrderList::all();
        $array = Array();
        $array['data'] = $order_list;
        if (count($order_list) > 0) {
            return response()->json($array, 200);
        } else {
            return response()->json(['error' => 'Order List not found'], 404);
        }
    }

    public function show($id) {
        $order_list = OrderList::find($id);
        $array = Array();
        $array['data'] = $order_list;
        if (count($order_list) > 0) {
            return response()->json($array, 200);
        } else {
            return response()->json(['error' => 'Order List not found'], 404);
        }
    }

    public function destroy($id) {
        $order_list = OrderList::where('id', $id)->delete();
        if ($order_list != null) {
            return response()->json($order_list, 200);
        } else {
            return response()->json(['error' => 'Order List cannot be deleted'], 404);
        }
    }

    public function store(Request $request) {
        $newOrderList = [
            'user_id' => $request->user_id,
            'item_id' => $request->item_id,
            'qty' => $request->qty,
        ];

        if ($newOrderList != null) {
            $new = $this->order_list->create($newOrderList);
            $array = Array();
            $array['data'] = $new;
            return response()->json($array, 200);
        } else {
            return response()->json(['error' => 'Order List not added'], 404);
        }
    }

    public function update(Request $request, $id) {
        $order_list = OrderList::where('id', $request->id)->update([
            'user_id' => $request->user_id,
            'item_id' => $request->item_id,
            'qty' => $request->qty,
        ]);
        if($order_list!=null){
            return response()->json($order_list, 200);
        } else {
            return response()->json(['error' => 'Order list not updated'], 404);
        }
    }

    public function getAllUserOrderListItem($user_id){
        $ordered_item = OrderList::where('user_id', $user_id)->get();
        if ($ordered_item != null) {
            return response()->json($ordered_item, 200);
        } else {
            return response()->json(['error' => 'Ordered item not updated'], 404);
        }
    }
}
