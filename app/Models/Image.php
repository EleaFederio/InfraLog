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
        // return $this->belongsTo(Project::class, 'images_projects', 'image_id', 'project_id');
        return $this->belongsToMany(Project::class);
    }
}
