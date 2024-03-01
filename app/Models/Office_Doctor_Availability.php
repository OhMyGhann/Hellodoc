<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office_Doctor_Availability extends Model
{
    use HasFactory;

    protected $fillable = ['office_id', 'day_of_week', 'start_time', 'end_time', 'is_available', 'reason_of_unavailablity'];
}
