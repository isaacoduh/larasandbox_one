<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

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

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function priceFor($from, $to): array
    {
        $days = (new Carbon($from))->diffInDays(new Carbon($to)) +1;
        $price = $days * $this->price;

        return [
            'total' => $price,
            'breakdown' => [
                $this->price = $days
            ],
        ];
    }

}
