<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Chat;
use App\User;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function show($id){
        
        $user = User::find($id);
        return view('chat.show',compact('user','id'));
    }
}
