<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use App\Gender;
use App\Status;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show($name)
    {
        $profile = Auth::user()->where('name',$name)->first()->profile;
        
        return view('profile.show', compact('profile'));
    }

    public function edit($name)
    {
        $profile = Auth::user()->where('name',$name)->first()->profile;
        $gender = Gender::all();
        $status = Status::all();
        return view('profile.edit', compact('profile','gender','status'));
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

        return redirect('/'.$name);
    }

    // public function store($id, Request $request)
    // {
    //     $request->validate([
    //         'foto_profile' => 'mimes:jpg,png,jpeg',
    //     ]);

    //     $profile = Profile::where('user_id',$id)->first();

    //     if($request->has('foto_profile')){
            
    //         if($profile->foto_profile!="ava.png"){
    //             $path = "avatar/";
    //             File::delete($path.$profile->foto_profile);
    //         }

    //         $fileName = 'IMG'.'-'.time().'.'.$request->foto_profile->extension();
    //        // dd($fileName);
    //         $request->foto_profile->move(public_path('avatar'),$fileName);

    //         $profile_data = [
    //             'foto_profile'=>$fileName,
    //             'umur'=>$request->umur,
    //             'bio'=>$request->bio,
    //             'alamat'=>$request->alamat,
    //         ];

    //     } else {
    //         $profile_data = [
    //             'umur'=>$request->umur,
    //             'bio'=>$request->bio,
    //             'alamat'=>$request->alamat,
    //         ];
    //     }
        
    //     $profile->update($profile_data);

    //     return redirect('/profile');
    // }
}
