<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = ['user_account_id', 'office', 'probable_start_time', 'actual_end_time', 'status', 'appointment_taken_date', 'app_booking_channel_id'];
}
