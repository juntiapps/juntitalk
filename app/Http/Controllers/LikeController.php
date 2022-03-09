<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function store(Request $request)
    {
        //dd($request->all());

        $like = new Like;

        $like->user_id = Auth::id();
        $like->post_id = $request->post_id;
        $like->save();

        return redirect()->back();
    }

    public function destroy($id)
    {
        // dd($id);
        Like::find($id)->delete();
        
        return redirect()->back();
    }
}
