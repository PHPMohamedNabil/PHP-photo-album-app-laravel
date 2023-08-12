<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FollowController extends Controller
{
    //

    public function followUnfollow(Request $request)
    {
        $follower_id = User::find(auth()->user()->id);
        $following_id = User::find($request->user_id);
        $follower_id->follwing()->toggle($following_id);

        return true;
    }

    public function userAvatar($id)
    {
        $user     = User::where('id',$id)->get();
        return $user[0]->profile_pic;
    }

    public function updateProfilePic(Request $request)
    {  
        $request->validate(['image'=>'required|mimes:jpg,jpeg,png']);

        $image = $request->image->store('public/avatar');
        $authuser = auth()->user()->id;
        $user     = User::where('id',$authuser)->update(['profile_pic'=>$image]);
        return response()->json(['done']);
    }
    public function updateBg(Request $request)
    {  
        $request->validate(['image'=>'required|mimes:jpg,jpeg,png']);

        $image = $request->image->store('public/avatar');
        $authuser = auth()->user()->id;
        $user     = User::where('id',$authuser)->update(['bg_pic'=>$image]);
        return response()->json(['done']);
    }
  
    public function backgroundUser($id)
    {
        $user     = User::where('id',$id)->get();
        return $user[0]->bg_pic;
    }
}
