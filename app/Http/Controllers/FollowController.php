<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Follow;

class FollowController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $follow = new Follow;

        $follow->follower_id = Auth::id();
        $follow->user_id = $request->user_id;
        $follow->save();

        return redirect()->back();
    }

    public function destroy($id)
    {
        // dd($id);
        Follow::find($id)->delete();
        
        return redirect()->back();
    }
}
