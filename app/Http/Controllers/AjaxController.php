<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Chat;
use Illuminate\Support\Facades\Auth;


class AjaxController extends Controller
{
    public function catch($id){
        
        $chatfrom = Chat::where("user_id", Auth::id())->where("to_user_id",$id)->get();
        $chatto = Chat::where("to_user_id", Auth::id())->where("user_id",$id)->get();
        // dd($chat);
        $chats=$chatfrom->merge($chatto);
      
        $sorted=$chats->SortBy("created_at")->values();
        // dd($sorted,$chats);
        
        return response()->json(['sorted'=>$sorted]);
    }

    public function store(Request $request)
    {
        $chat = new Chat;
        if ($request->picture!=null){
            $request->validate([
                'picture' => 'mimes:jpg,png,jpeg',
            ]);
            if($request->chat!=null){
                $ch=$request->chat;
            } else {
                $ch='';
            }

            $fileName = time(). '.'. $request->picture->extension();

            $chat->picture = $fileName;
            $chat->chat = $ch;
            $chat->to_user_id = $request->to_user_id;
            $chat->user_id = Auth::id();

            $chat->save();

            $request->picture->move(public_path('imagechat'),$fileName);
        } else {
            $request->validate([
                'chat' => 'required',
            ]);

            $chat->picture = '';
            $chat->chat = $request->chat;
            $chat->to_user_id = $request->to_user_id;
            $chat->user_id = Auth::id();

            $chat->save();
        }
        
        return response()->json(['status'=>200]);
        // redirect(route('chats'));
    }
}
