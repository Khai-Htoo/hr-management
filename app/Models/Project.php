<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable =[
        'title',
        'description',
        'image',
        'files',
        'start_date',
        'deadline',
        'priority',
        'status'
    ];

    protected $casts = [
        'image' => 'array',
        'files' =>'array'
    ];

    public function task(){
        return $this->hasMany(Task::class);
    }

    public function teamLeader(){
        return $this->belongsToMany(User::class,'team_leaders','project_id','user_id');
    }

    public function teamMember(){
        return $this->belongsToMany(User::class,'team_menbers','project_id','user_id');
    }
}
