<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show($id)
    {
        $profile = App\Profile::find($id);

        return view('profile.show', compact('profile'));
    }

    public function edit($id)
    {
        $profile = App\Profile::find($id);
        
        return view('profile.edit', compact('profile'));
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
