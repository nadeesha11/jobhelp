<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class otpVerification extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','otp','expire_at' ];


}
