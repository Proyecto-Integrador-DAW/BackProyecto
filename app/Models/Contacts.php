<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Contacts extends Model
{
    use HasFactory;
    protected $fillable = ['dni', 'name', 'adress', 'phone_number', 'email'];

    public function patients()
    {
        return $this->belongsToMany(Patients::class, 'contact_patient')->withPivot('relationship');
    }
}
