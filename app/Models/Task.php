<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['project_id','title','description','start_date','deadline','priority','status'];

    public function member(){
        return $this->belongsToMany(User::class,'taskmembers','project_id','user_id');
    }
}
