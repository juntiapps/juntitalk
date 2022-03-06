<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = "chats" ;
    protected $fillable = ["user_id", "to_user_id", "chat","picture"];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
