<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drink extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $table = 'drinks';
    protected $fillable = ['name', 'size_id', 'name_id'];

    public function drinkName(){
        return $this->hasMany(DrinkName::class,'id', 'name_id');
    }

    public function drinkSize(){
        return $this->hasMany(DrinkSize::class, 'id', 'size_id');
    }

    public function item(){
        return $this->belongsTo('App\Model\Item');
    }

}
