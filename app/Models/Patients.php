<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Patients extends Model
{
    use HasFactory;
    protected $fillable = ['dni', 'name', 'birth_date', 'address', 'phone_number', 'health_card', 'email', 'zone_id', 'personal_situation', 'health_situation', 'housing_situation', 'economic_situation', 'autonomy'];
    
    public function contacts()
    {
        return $this->belongsToMany(Contacts::class, 'contact_patient', 'patient_id', 'contact_id')
            ->withPivot('relationship');
    }

    public function zone()
    {
        return $this->belongsTo(Zones::class);
    }

}
