<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'states';
    protected $fillable = ['name','country_id'];

    public static function states($id){
        return State::where('country_id','=',$id)->get();
    }
}
