<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $fillable = [
        'title', 'artist', 'genre', 'year_released', 'record_label'
    ];
}
