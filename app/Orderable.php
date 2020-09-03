<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orderable extends Model
{
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function availableFor($from, $to): bool
    {
        return 0 === $this->orders()->betweenDates($from, $to)->count();
    }
}
