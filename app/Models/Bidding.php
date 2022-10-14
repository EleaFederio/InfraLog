<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bidding extends Model
{
    use HasFactory;

    protected $fillable = ['pre_bid', 'opening_of_bids', 'start_of_posting', 'end_of_posting'];

    public function projects(){
        return $this->hasMany(Project::class);
    }
}
