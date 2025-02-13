<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Warnings extends Model
{
    use HasFactory;
    protected $fillable = ['description', 'type_id', 'start_date', 'end_date', 'periodicity', 'week_day'];

    public function type()
{
    return $this->belongsTo(WarningTypes::class, 'type_id');
}

    
}
