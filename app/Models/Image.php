<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

    protected $fillable = [
        'image_path'
    ];

    use HasFactory;

    public function projects(){
        return $this->belongsToMany(Project::class);
    }

    public function activities(){
        return $this->belongsToMany(Activity::class);
    }
}
