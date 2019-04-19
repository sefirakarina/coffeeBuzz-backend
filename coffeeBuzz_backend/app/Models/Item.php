<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public $timestamps = false;
    protected $table = 'items';
    protected $fillable = ['id', 'item_type', 'food_id', 'drink_id'];

    public function foods(){
        return $this->hasMany('App\Models\Drink', 'id');
    }

    public function drinks(){
        return $this->hasMany('App\Models\Food', 'id');
    }

    protected $primaryKey = 'id';
}
