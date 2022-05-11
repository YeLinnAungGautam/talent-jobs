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
    public function UserModelForApplyJob(){
        return $this->belongsTo(ApplyJob::class,'user_id');
    }
    public function JobsListModelForApplyJob(){
        return $this->belongsTo(Jobs::class,'user_id');
    }
}
