<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class App_Booking_Channel extends Model
{
    use HasFactory;

    protected $fillable = ['app_booking_channel_name'];
}
