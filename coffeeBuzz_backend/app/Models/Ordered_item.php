<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ordered_item extends Model
{
    protected $table = 'ordered_items';
    protected $fillable = ['cart_id'];

    public function carts(){
        return $this->belongsTo('App\Models\Cart', 'id');
    }
}
