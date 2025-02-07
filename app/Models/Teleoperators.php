<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Teleoperators extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'phoneNumber', 'zoneId', 'motherTongue', 'hiringDate', 'code', 'password', 'firingDate'];
}
