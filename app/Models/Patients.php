<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Patients extends Model
{
    use HasFactory;
    protected $fillable = ['DNI', 'name', 'adress', 'phoneNumber', 'healthCard', 'email', 'zoneId', 'personalSituation', 'healthSituation', 'housingSituation', 'economicSituation', 'autonomy'];
}
