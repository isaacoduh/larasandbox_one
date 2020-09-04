<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }

    public function orderable()
    {
        return $this->belongsTo(Orderable::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
