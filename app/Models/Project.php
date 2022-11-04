<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'amount',
        'project_status_id',
        'details',
        'contractor',
        'project_engineer_id',
        'project_inspector_id',
        'start_date',
        'original_completion_date',
        'revised_completion_date'
    ];

    public function project_engineer(){
        return $this->belongsTo(Engineer::class);
    }

    public function project_inspector(){
        return $this->belongsTo(Engineer::class);
    }

    public function bidding(){
        return $this->belongsToMany(Bidding::class);
    }
}
