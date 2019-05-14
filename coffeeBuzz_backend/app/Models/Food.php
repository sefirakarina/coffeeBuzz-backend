<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    public $timestamps = false;
    protected $table = 'foods';
    protected $fillable = ['name', 'qty', 'price'];

    public function item(){
        return $this->belongsTo('App\Model\Item');
    }

    public static function foods(){
        return Food::all();
    }
}
