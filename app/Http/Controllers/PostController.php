<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $request->validate([
            'picture' => 'mimes:jpg,png,jpeg',
            'post' => 'required'
        ]);
        
        $post = new Post;

        if($request->has('picture')){
        $fileName = time(). '.'. $request->picture->extension();

        $post->picture = $fileName;
        $post->post = $request->post;
        $post->user_id = Auth::id();

        $post->save();
        $request->picture->move(public_path('imagepost'),$fileName);
        } else {
            $post->picture = '';
            $post->post = $request->post;
            $post->user_id = Auth::id();
            $post->save();
        }
        
        return redirect()->back();
    }

    public function show($id)
    {
        $post = Post::find($id);

        return view('post.show', compact('post'));
    }

    public function destroy($id)
    {
        //Komentar::where('post_id', $id)->delete();
        dd($id);
        Post::find($id)->delete();
        
        return redirect()->back();
    }
}
