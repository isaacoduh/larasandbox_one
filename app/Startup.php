<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Startup extends Model
{
    protected $fillable = [
        'name', 'sector', 'founded', 'headquarters', 'bio'
    ];
}
