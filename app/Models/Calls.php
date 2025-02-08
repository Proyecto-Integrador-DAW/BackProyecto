<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Calls extends Model
{
    use HasFactory;
    protected $fillable = [
        'date_time',
        'operator_id',
        'patient_id',
        'description',
        'call_type',
        'type_id',
        'warning_id',
    ];
}
