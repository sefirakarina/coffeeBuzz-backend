<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_list extends Model
{
    public $timestamps = false;
    protected $table = 'order_lists';
    protected $fillable = ['cart_id', 'item_type','qty'];

    public function items(){
        return $this->hasMany('App\Models\Item', 'id');
    }
}
