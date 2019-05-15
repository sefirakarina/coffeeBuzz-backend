<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderList extends Model
{
    public $timestamps = false;
    protected $table = 'order_lists';
    protected $fillable = ['user_id', 'item_id','qty'];

    public function items(){
        return $this->hasMany('App\Models\Item', 'id');
    }

    public function users(){
        return $this->belongsTo('App\Models\User');
    }

    public static function orderLists(){
        return OrderList::all();
    }
}
