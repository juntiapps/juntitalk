<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use App\Gender;
use App\Status;
use App\Follow;
use App\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show($name)
    {
        $profile = Auth::user()->where('name',$name)->first()->profile;
        $users = User::all();
        // dd(Follow::where('user_id',Auth::id())->user);
        $following = Follow::where('follower_id',Auth::id())->get();
        $follower = Follow::where('user_id',Auth::id())->get();
        $follow = Follow::all();
        return view('profile.show', compact('profile','following','follower','follow','users'));
    }

    public function edit($name)
    {
        $profile = Auth::user()->where('name',$name)->first()->profile;
        $gender = Gender::all();
        $status = Status::all();
        return view('profile.show', compact('profile','gender','status'));
    }

    public function update(Request $request,$name)
    {
        $request->validate([
            'profile_picture' => 'mimes:jpg,png,jpeg',
        ]);
        // dd($request->all());
        $profile = Auth::user()->where('name',$name)->first()->profile;

        if($request->has('profile_picture')){
            
            if($profile->profile_picture!="default.jpg"){
                $path = "ava/";
                File::delete($path.$profile->profile_picture);
            }

            $fileName = 'IMG'.'-'.time().'.'.$request->profile_picture->extension();
           // dd($fileName);
            $request->profile_picture->move(public_path('ava'),$fileName);

            $profile_data = [
                'profile_picture'=>$fileName,
                'display_name'=>$request->display_name,
                'birthday'=>$request->birthday,
                'gender_id'=>$request->gender_id,
                'status_id'=>$request->status_id,
                'bio'=>$request->bio,
                'address'=>$request->address,
            ];

        } else {
            $profile_data = [
                'display_name'=>$request->display_name,
                'birthday'=>$request->birthday,
                'gender_id'=>$request->gender_id,
                'status_id'=>$request->status_id,
                'bio'=>$request->bio,
                'address'=>$request->address,
            ];
        }
        
        $profile->update($profile_data);

        return redirect()->back();
    }
}