<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Shop extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function toSearchableArray()
    {
        $array = Arr::only($this->toArray(), ['name']);
        $array["state"] = $this->state->id;
        $array["area"] = $this->area->id;
        return $this->transform($array);
    }

    public function state()
    {
        return $this->belongsTo('App\State');
    }

    public function area()
    {
        return $this->belongsTo('App\Area');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
