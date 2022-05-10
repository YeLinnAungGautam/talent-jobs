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
        'necessary_skills',
        'location_id',
        'category_id'
    ];     
    protected $casts = [
        'necessary_skills' => 'array'
        ];
    public function jobsmodel(){
        return $this->hasMany(Location::class,'id');
    }
    public function jobscategoriesmodel(){
        return $this->hasMany(JobCategory::class,'id');
    }
}
