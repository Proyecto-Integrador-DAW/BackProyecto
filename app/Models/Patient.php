<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\SoftDeletes;
    use Illuminate\Database\Eloquent\Model;

    /**
     * @OA\Schema(
     *     schema="Patient",
     *     description="Esquema del modelo Patient",
     *     @OA\Property(property="id", type="integer", description="ID del paciente"),
     *     @OA\Property(property="dni", type="string", description="DNI del paciente"),
     *     @OA\Property(property="name", type="string", description="Nombre del paciente"),
     *     @OA\Property(property="birth_date", type="string", format="date", description="Fecha de nacimiento del paciente"),
     *     @OA\Property(property="address", type="string", description="Dirección del paciente"),
     *     @OA\Property(property="phone_number", type="string", description="Número de teléfono del paciente"),
     *     @OA\Property(property="health_card", type="string", description="Número de tarjeta sanitaria del paciente"),
     *     @OA\Property(property="email", type="string", format="email", description="Correo electrónico del paciente"),
     *     @OA\Property(property="zone_id", type="integer", description="ID de la zona del paciente"),
     *     @OA\Property(property="personal_situation", type="string", description="Situación personal del paciente"),
     *     @OA\Property(property="health_situation", type="string", description="Situación de salud del paciente"),
     *     @OA\Property(property="housing_situation", type="string", description="Situación de vivienda del paciente"),
     *     @OA\Property(property="economic_situation", type="string", description="Situación económica del paciente"),
     *     @OA\Property(property="autonomy", type="string", description="Nivel de autonomía del paciente")
     * )
     */    
    class Patient extends Model {

        use HasFactory, SoftDeletes;

        protected $fillable = ['dni', 'name', 'birth_date', 'address', 'phone_number', 'health_card', 'email', 'zone_id', 'associated_teleoperator_id', 'personal_situation', 'health_situation', 'housing_situation', 'economic_situation', 'autonomy'];

        public function emergencyContacts() {
            return $this->belongsToMany(EmergencyContact::class, 'patient_emergency_contact')->withTimestamps();
        }

        public function zone() {
            return $this->belongsTo(Zone::class);
        }

        public function calls() {
            return $this->hasMany(Call::class);
        }

        public function alerts() {
            return $this->hasMany(Alert::class, 'zone_id', 'zone_id');
        }

        public function teleoperator() {
            return $this->belongsTo(Teleoperator::class, 'associated_teleoperator_id');
        }
    }
?>