<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DrinkSize extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $table = 'drink_sizes';
    protected $fillable = ['size'];

    public function drinks(){
        return $this->belongsTo('App\Model\Drinks');
    }
}
