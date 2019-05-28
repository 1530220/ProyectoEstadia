<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    //protected $primaryKey = 'num_employee';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'siita_db.users';
    protected $fillable = [
        'id','university_id', 'username', 'password', 'remember_token','title', 'name', 'first_name', 'last_name', 'second_last_name',
            'email', 'password', 'type', 'username',
    ];

}
