<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = "profiles";
    protected $fillable = [
        'user_id',
        'display_name', 
        'profile_picture', 
        'birthday', 
        'gender_id', 
        'address', 
        'status_id', 
        'bio'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
