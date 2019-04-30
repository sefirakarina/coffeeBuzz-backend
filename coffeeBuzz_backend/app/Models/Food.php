<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    public $timestamps = false;
    protected $table = 'foods';
    protected $fillable = ['name'];

    public function item(){
        return $this->belongsTo('App\Model\Item');
    }
}
