<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Check extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','check_in','check_out','date'];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
