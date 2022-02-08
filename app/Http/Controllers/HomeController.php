<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $post = Post::all();
        $comment = Comment::all();
        return view('home', compact('post','comment'));
    }

    public function storePost(Request $request)
    {
        $request->validate([
            'picture' => 'mimes:jpg,png,jpeg',
            'post' => 'required'
        ]);

        $fileName = time(). '.'. $request->picture->extension();
        $post = new Post;

        $post->picture = $fileName;
        $post->post = $request->post;
        $post->user_id = Auth::id();

        $post->save();
        $request->picture->move(public_path('imagepost'),$fileName);
        return redirect()->back();
    }

    public function storeComment(Request $request)
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
}
