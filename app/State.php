<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    public $timestamps = false;

    public function shops()
    {
        return $this->hasMany('App\Shop');
    }

    public function areas()
    {
        return $this->hasMany('App\Area');
    }
}
