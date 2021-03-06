<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{   
    protected $table = 'genders';

    public function profile()
    {
        return $this->hasMany('App\Profile');
    }
}
