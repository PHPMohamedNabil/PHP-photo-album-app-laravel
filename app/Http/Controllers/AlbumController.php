<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Album;
use App\Models\Category;
use App\Http\Resources\AlbumResource;

class AlbumController extends Controller
{
    //

    public function getAlbums()
    {
        return new AlbumResource(Album::with('category')->where('user_id',auth()->user()->id)->paginate(3));
    }

    public function index()
    {
        return view('album.index');
    }

    public function create()
    {
        return view('album.create');
    }

    public function store(Request $request)
    {
         $this->validate($request,[
               'name'=>['required','min:3','max:15'],
               'description'=>['required','min:3','max:255'],
               'image'=>['required','mimes:jpeg,jpg,png'],
               'category_id'=>['required','integer']
         ]);
          $image_name = $request->image->hashName();
          $request->image->move(public_path('album'),$image_name);

          $album = Album::create([
              'name'=>$request->name,
              'description'=>$request->description,
              'slug'=>Str::slug($request->name),
              'category_id'=>$request->category_id,
              'user_id'=>auth()->user()->id,
              'image'=>$image_name
          ]);

          return response()->json(['id'=>$album->id]);
    }

    public function getOneAlbum($id)
    {
       return Album::with('category')->find($id);
    }

    public function update($id,Request $request)
    {
        $album = Album::find($id);
        $photo = $album->image;
        if($request->hasFile('image'))
        {
            $file  = $request->file('image');
            $photo = $file->hashName();
            $file->move('./album/',$photo);

        }

        $album->name = $request->name;
        $album->description = $request->description;
        $album->category_id = $request->category_id;
        $album->image       = $photo;

        

        $success = $album->save();

        if($success)
        {
            return response()->json($this->getAlbums());
        }

    }

    public function destroy($id,Request $request)
    {
          $album = Album::find($id)->delete();

          if($album)
          {
             return response()->json($this->getAlbums());
          }
    }

    public function getAlbumsByCategory($id,$cat_name)
    {   
        $category = Category::where('id',$id)->where('name',$cat_name)->get();
        
        if(!count($category) > 0)
        {
           return abort(404);  
        }
         return Album::where('category_id',$id)->paginate();
    }


}
