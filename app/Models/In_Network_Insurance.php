<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class In_Network_Insurance extends Model
{
    use HasFactory;

    protected $fillable = ['insurance_name', 'office_id'];
}
