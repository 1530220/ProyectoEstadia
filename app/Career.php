<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    /** @var array */
    protected $fillable = [
        'id', 'name', 'abbreviation'
    ];
}
