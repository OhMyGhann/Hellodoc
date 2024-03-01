<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client_Account extends Model
{
    use HasFactory;
    protected $table = 'client__accounts';

    protected $fillable = ['first_name', 'last_name', 'contact_number', 'email'];
}
