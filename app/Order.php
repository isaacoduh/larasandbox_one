<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    protected $fillable = ['from', 'to'];

    public function orderable()
    {
        return $this->belongsTo(Orderable::class);
    }

    public function scopeBetweenDates(Builder $query, $from, $to)
    {
        return $query->where('to', '>=', $from)->where('from', '<=', $to);
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }

    public static function findByReviewKey(string $reviewKey): ?Order
    {
        return static::where('review_key', $reviewKey)->with('orderable')->get()->first();
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function($order){
            $order->review_key = Str::uuid();
        });
    }
}
