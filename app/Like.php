<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = "likes" ;
    protected $fillable = ["user_id", "post_id", "liker_id"];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function post(){
        return $this->belongsTo('App\Post');
    }

    public function like(){
        return $this->belongsTo('App\User');
    }
}
