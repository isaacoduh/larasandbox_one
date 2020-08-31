<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    public $timestamps = false;

    public function shops()
    {
        return $this->hasMany('App\Shop');
    }

    public function state()
    {
        return $this->belongsTo('App\State');
    }
}
