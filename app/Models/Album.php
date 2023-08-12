<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\User;

class Album extends Model
{
    use HasFactory;

    protected $guarded= [];


    public function category()
    {
        return $this->hasOne(Category::class,'id','category_id');
    }

    public function albumimages()
    {
        return $this->hasMany(Image::class,'album_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
