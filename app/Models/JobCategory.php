<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];
    public function jobcategories(){
        return $this->belongsTo(Jobs::class,'category_id');
    }
}
