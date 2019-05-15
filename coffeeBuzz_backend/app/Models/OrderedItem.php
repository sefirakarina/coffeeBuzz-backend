<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderedItem extends Model
{
    protected $table = 'ordered_items';
    protected $fillable = ['user_id', 'item_id','qty'];
    public $timestamps = false;

    public function items(){
        return $this->hasMany('App\Models\Item', 'id');
    }

    public function users(){
        return $this->belongsTo('App\Models\User');
    }

    public static function orderedItems(){
        return OrderedItem::all();
    }
}
