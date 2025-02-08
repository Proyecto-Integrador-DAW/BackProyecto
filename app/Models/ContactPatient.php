<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ContactPatient extends Model
{
    use HasFactory;
    protected $table = 'contact_patient';
    protected $fillable = ['patient_id', 'contact_id', 'relationship'];
}
