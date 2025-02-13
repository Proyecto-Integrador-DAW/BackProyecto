<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class AlertCategory extends Model
{
    use HasFactory;
    protected $fillable = ['description'];
}
