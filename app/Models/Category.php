<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Album;

class Category extends Model
{
    use HasFactory;


    public function album()
    {
        return $this->hasMany(Album::class);
    }
}
