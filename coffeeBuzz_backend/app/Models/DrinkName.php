<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DrinkName extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $table = 'drink_names';
    protected $fillable = ['name'];
}
