<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderedItem extends Model
{
    protected $table = 'ordered_items';
    protected $fillable = ['cart_id'];
    public $timestamps = false;

    public function carts(){
        return $this->belongsTo('App\Models\Cart');
    }
}
