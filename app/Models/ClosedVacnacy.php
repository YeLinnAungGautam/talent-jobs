<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClosedVacnacy extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'job_id'
    ];     

    public function user(){
        return $this->belongsTo(User::class,'id');
    }

    public function totalCancelJob(){
        return $this->hasMany(ClosedVacnacy::class,'user_id');
    }
}
