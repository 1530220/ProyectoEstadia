<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $primaryKey = 'user_id';

    /** @var array */
    protected $fillable = [
        'user_id', 'academic_situation', 'career_id', 'tutor_user_id','phone',
    ];

}
