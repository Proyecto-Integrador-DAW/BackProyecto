<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Teleoperator extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'phone_number', 'zone_id', 'mother_tongue', 'hiring_date', 'code', 'password', 'firing_date'];
}
