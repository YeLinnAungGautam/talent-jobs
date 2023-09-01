<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'body',
        'user_id',
        'job_id'
    ];
    // public function user(){
    //     return $this->belongsTo(User::class,'user_id');
    // }

    public function user(){
        return $this->hasMany(User::class,'id');
    }

    public function job(){
        return $this->belongsTo(Jobs::class,'job_id');
    }
}
