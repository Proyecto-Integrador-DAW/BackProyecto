<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Zone extends Model
{
    use HasFactory;
    protected $fillable = ['city','zone'];
}
