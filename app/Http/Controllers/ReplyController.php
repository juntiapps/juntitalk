<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reply;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $request->validate([
            'reply' => 'required'
        ]);
        // dd($request->all());
        $reply = new Reply;

        $reply->user_id = Auth::id();
        $reply->comment_id = $request->comment_id;
        $reply->reply = $request->reply;
        $reply->save();

        return redirect()->back();
    }

    public function destroy($id)
    {
        Reply::find($id)->delete();
        
        return redirect()->back();
    }
}
