<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drink extends Model
{
    public $timestamps = false;
    protected $table = 'drinks';
    protected $fillable = ['name', 'drink_type'];
}
