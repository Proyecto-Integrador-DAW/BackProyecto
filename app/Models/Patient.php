<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\SoftDeletes;
    use Illuminate\Database\Eloquent\Model;

    class Patient extends Model {

        use HasFactory, SoftDeletes;

        protected $fillable = ['dni', 'name', 'birth_date', 'address', 'phone_number', 'health_card', 'email', 'zone_id', 'personal_situation', 'health_situation', 'housing_situation', 'economic_situation', 'autonomy'];

        public function emergencyContacts() {
            return $this->belongsToMany(EmergencyContact::class, 'patient_emergency_contact')->withTimestamps();
        }

        public function zone() {
            return $this->belongsTo(Zone::class);
        }
    }
?>