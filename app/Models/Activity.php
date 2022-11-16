<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Activity extends Model
{

    protected $fillable = ['title', 'description'];

    use HasFactory;

    public function images(){
        return $this->belongsToMany(Image::class);
    }

}
