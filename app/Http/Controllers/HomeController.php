<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use App\Like;
use App\Follow;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware(['auth','verified']);
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $follow=Follow::all();
        $filter = $follow->where('follower_id', Auth::id())->map(function ($item,$key){
            return $item->user_id;
        });
        // dd($filter->concat([Auth::id()]));
        $post = Post::whereIn("user_id", $filter->concat([Auth::id()])->toArray())->get();
        return view('home', compact('post'));
    }

}
