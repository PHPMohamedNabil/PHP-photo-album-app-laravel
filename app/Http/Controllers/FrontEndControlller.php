<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Follower;
use App\Models\User;

class FrontEndControlller extends Controller
{
    //

    public function index(Request $request)
    { 
        if($request->title)
        {
            if($request->type=='album')
            {
                 $albums    = Album::where('name','LIKE','%'.$request->title.'%')->paginate(50);

                 $title     = $request->title; 
                 $type      = $request->type;

                return view('home_search',compact('albums','title','type'));
            }
            elseif($request->type =='users')
            {   
                 $users    = User::where('name','LIKE','%'.$request->title.'%')->orWhere('email','LIKE','%'.$request->title.'%')->orWhere('id','LIKE','%'.$request->title.'%')->paginate(50);

                 $title    = $request->title;

                 $type      = $request->type;
                    
                   // dd($users);
                return view('home_search',compact('users','title','type'));

            }
            else
            {
                return redirect()->back();
            }

        }

        if(isset(auth()->user()->id))
        {
              //dd(User::follwingIds()[0]->following_id);
            $ids =[];

            foreach (User::follwingIds() as $following)
            {
                 $ids[]=$following->following_id;
            }

             $albums    = Album::latest()->whereIN('user_id',$ids)->paginate(50);
             
             return view('home',compact('albums'));
        }

        $albums    = Album::latest()->paginate(50);
         
         return view('home',compact('albums'));
    }

    public function userprofile()
    { 
        // $albums    = Album::latest()->paginate(50);
          $followers = Follower::where('follower_id',auth()->user()->id)->get();
           
          if(count($followers) > 0)
          {
               //  dd($followers);
            foreach($followers as $following)
            {
             // dd('ww');
               $user_id = $following->userfollow->id;
               $follows = (new User)->amIFollowing($user_id);
            }
             return view('profile',compact('followers','user_id','follows'));
          }
               $user_id =0;
               $follows =0;
          return view('profile',compact('followers','user_id','follows'));
         
    }

    public function useralbums($id)
    {
        $albums = Album::where('user_id',$id)->paginate(10);
        
        $background = User::where('id',$id)->get()[0]->bg_pic;
        return view('user_album',compact('albums','background','id'));
    }

    public function userAvatar(Request $request)
    {
        
    }

    public function updateProfilePic(Request $request)
    {
        
    }
}
