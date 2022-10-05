<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Engineer extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'middle_name'];

    public function projects(){
        return $this->hasMany(Project::class);
    }
}
