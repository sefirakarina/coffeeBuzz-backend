<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $table = 'roles';
    protected $fillable = ['role'];

    public function users(){
        return $this->belongsTo('App\Model\User');
    }
}
