<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public $timestamps = false;
    protected $table = 'carts';
    protected $fillable = ['user_id'];

    public function users(){
        return $this->belongsTo('App\Models\User', 'id');
    }
}
