<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment_Status extends Model
{
    use HasFactory;

    protected $fillable = ['status'];
}
