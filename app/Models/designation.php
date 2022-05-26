<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class designation extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_name',
        'salary',
        'position',
        'user_id'
    ];
    public function DesignationForUser(){
        return $this->belongsTo(User::class,'user_id');
    } 
    // public function DesignationForUserIndex(){
    //     return $this->hasMany(designation::class,'id','user_id');
    // }
}
