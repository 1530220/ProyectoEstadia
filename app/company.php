<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class company extends Model
{
    protected $table = 'companies';
    protected $fillable = [
        'id','rfc', 'name', 'phone', 'image_url','country', 'state', 'city', 'zip', 'colony',
            'street', 'schedule', '	description', 'deleted',
    ];
}
