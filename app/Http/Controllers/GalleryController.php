<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Album;
use App\Models\User;

class GalleryController extends Controller
{
    //

    public function create($id)
    {    
        $user_has_album = Album::where('user_id',auth()->user()->id)->where('id',$id)->exists();

        if($user_has_album)
        {
           session()->put('id',$id);
          return view('image.create',['album_id'=>$id]);
        }
        return redirect()->route('albums');
       
    }

    public function upload(Request $request)
    {        
         $this->validate($request,[
             'files'=>'required',
             'files.*'=>'mimes:jpg,jpeg,png'
         ]);
          foreach($request->file('files') as $file)
          {
            $name = $file->hashName();
            $file->move(public_path().'/images/',$name);

            $file = new Image();

            $file->album_id = $request->album_id;
            $file->image    = $name;
            $file->save();

          }

          return response()->json(['success'=>$request->file('files')]);
    }

    public function images(){
          
      return Image::where('album_id',session()->get('id'))->get();
    }

    public function destroy($image_id)
    {
       $image = Image::find($image_id);
        
       return $image->delete();
    }

    public function viewAlbum($slug,$id)
    {   
       $albums = Album::with('albumimages')->where('id',$id)->where('slug',$slug)->get();
       $user_id = Album::where('id',$id)->first()->user_id;
       
       if(isset(auth()->user()->id))
       {
         $follows = (new User)->amIfollowing($user_id);
         return view('album.show',compact('follows','user_id','albums'));
       }
        
        return view('album.show',compact('albums'));
    }

  
    
}
