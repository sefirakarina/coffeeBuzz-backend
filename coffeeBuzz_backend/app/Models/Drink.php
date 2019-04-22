<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drink extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $table = 'drinks';
    protected $fillable = ['name', 'size_id', 'name_id'];
}
