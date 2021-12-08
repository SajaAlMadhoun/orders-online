<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $table = 'drivers';
    //one to many
    public function orders(){
      return $this->hasMany('App\Models\Order');
    }
}
