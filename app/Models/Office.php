<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use HasFactory;

    protected $fillable = ['doctor_id', 'hospital_affiliation_id', 'time_slot_per_client_in_min', 'first_consultation_fee', 'followup_consultation_fee', 'street_address', 'city', 'state', 'zip', 'country'];
}
