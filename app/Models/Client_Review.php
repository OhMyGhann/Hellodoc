<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client_Review extends Model
{
    use HasFactory;

    protected $fillable = ['user_account_id', 'doctor_id', 'is_review_anonymous', 'wait_time_rating', 'bedside_manner_rating', 'overall_rating', 'review', 'is_doctor_recommended', 'review_date'];
}
