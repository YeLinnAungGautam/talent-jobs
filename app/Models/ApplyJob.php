<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplyJob extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'job_id',
    ];
    public function ApplyJobUserModel(){
        return $this->hasMany(User::class,'id','user_id'); 
    }

    public function ApplyJobListModel(){
        return $this->hasMany(Jobs::class,'id','job_id');
    } 
    public function ApplyJobLocation(){
        return $this->hasMany(Location::class,'id','location_id');
    }
    public function ApplyJobCategories(){
        return $this->hasMany(JobCategory::class,'id','category_id');
    }
    public function ApplyJobdesignation(){
        return $this->hasMany(designation::class,'user_id');
    }
}
