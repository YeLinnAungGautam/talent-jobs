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
    public function jobsmodel(){
        return $this->hasMany(Location::class,'id');
    }
    public function jobscategoriesmodel(){
        return $this->hasMany(JobCategory::class,'id');
    }
    public function ApplyJobListModel(){
        return $this->hasMany(Jobs::class,'id');
    }
}
