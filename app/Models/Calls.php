<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Calls extends Model
{
    use HasFactory;
    protected $fillable = ['dateTime', 'operatorId', 'patientId', 'description', 'callType', 'type', 'warningId'];
}
