<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailSender extends Model
{
    use HasFactory;
    protected $fillable = [
        'sender_email',
        'staff_name'
    ];
    public function jobsemailsender(){
        return $this->belongsTo(Jobs::class,'email_receiver');
    }

    public function user(){
        return $this->belongsTo(User::class,'id');
    }

    public function totalCancelJob(){
        return $this->hasMany(ClosedVacnacy::class,'user_id');
    }

}
