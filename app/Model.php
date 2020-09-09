<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model as BaseModel;

class Model extends BaseModel
{
    /**
     * Indicates if IDs are auto incrementing
     *
     */
    public $incrementing = false;

    protected $guarded = [];

    /**
     * The booting method of the model
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model){
            $model->{$model->getKeyName()} = (string) Str::uuid();
        });
    }
}
