<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital_Affiliation extends Model
{
    use HasFactory;

    protected $fillable = ['doctor_id', 'hospital_name', 'city', 'country', 'start_date', 'end_date'];
}
