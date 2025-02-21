<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\SoftDeletes;
    use Illuminate\Database\Eloquent\Model;
/**
 * @OA\Schema(
 *     schema="EmergencyContact",
 *     description="Esquema del modelo EmergencyContact",
 *     @OA\Property(property="id", type="integer", description="ID del contacto de emergencia"),
 *     @OA\Property(property="name", type="string", description="Nombre del contacto de emergencia"),
 *     @OA\Property(property="phone_number", type="string", description="Número de teléfono del contacto de emergencia"),
 *     @OA\Property(property="relationship", type="string", description="Relación con el paciente"),
 *     @OA\Property(property="created_by", type="integer", nullable=true, description="ID del usuario que creó el contacto")
 * )
 */
    class EmergencyContact extends Model {
        
        use HasFactory, SoftDeletes;

        protected $fillable = ['name', 'phone_number', 'relationship', 'created_by'];

        public function patients() {
            return $this->belongsToMany(Patient::class, 'patient_emergency_contact');
        }
    }
?>