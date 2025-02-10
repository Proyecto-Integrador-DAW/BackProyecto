<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Warnings extends Model
{
    use HasFactory;
    protected $fillable = ['description', 'type', 'start_date', 'end_date', 'periodicity', 'week_day'];
    
}
