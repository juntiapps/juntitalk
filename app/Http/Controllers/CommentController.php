<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required'
        ]);

        $comment = new Comment;

        $comment->user_id = Auth::id();
        $comment->post_id = $request->post_id;
        $comment->comment = $request->comment;
        $comment->save();

        return redirect()->back();
    }

    public function destroy($id)
    {
        //Komentar::where('post_id', $id)->delete();
        dd($id);
        Comment::find($id)->delete();
        
        return redirect()->back();
    }
}
