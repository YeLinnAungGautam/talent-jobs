<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{ 
    use HasFactory;
    protected $fillable = [
        'job_title',
        'job_description',
        'qualification',
        'location_id',
        'category_id',
        'salary',
        'township',
        'experiences',
        'responsibilities'
    ];     
    // protected $casts = [
    //     'necessary_skills' => 'array'
    //     ];
    public function location(){
        return $this->hasMany(Location::class,'id','location_id');
    }
    public function category(){
        return $this->hasMany(JobCategory::class,'id','category_id');
    }
    public function emailsender(){
        return $this->hasMany(EmailSender::class,'id','email_receiver');
    }
    public function JobsListModelForApplyJob(){
        return $this->belongsTo(Jobs::class,'user_id'); 
    }
    public function jobApply(){
        return $this->belongsTo(ApplyJob::class,'job_id');
    }
    public function jobApplys(){
        return $this->hasMany(ApplyJob::class,'job_id');
    }
}
