<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = ['dni', 'name', 'address', 'phone_number', 'email'];

    public function patients()
    {
        return $this->belongsToMany(Patient::class, 'contact_patient')->withPivot('relationship');
    }
}
