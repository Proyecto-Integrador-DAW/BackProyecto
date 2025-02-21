<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * @OA\Schema(
 *     schema="Call",
 *     description="Esquema del modelo Call",
 *     @OA\Property(property="id", type="integer", description="ID de la llamada"),
 *     @OA\Property(property="teleoperator_id", type="integer", description="ID del teleoperador que realizó la llamada"),
 *     @OA\Property(property="patient_id", type="integer", description="ID del paciente involucrado en la llamada"),
 *     @OA\Property(property="call_type", type="string", description="Tipo de llamada"),
 *     @OA\Property(property="type", type="string", description="Clasificación de la llamada"),
 *     @OA\Property(property="call_time", type="string", format="date-time", description="Fecha y hora de la llamada"),
 *     @OA\Property(property="title", type="string", description="Título de la llamada"),
 *     @OA\Property(property="description", type="string", description="Descripción de la llamada"),
 *     @OA\Property(property="alert_id", type="integer", nullable=true, description="ID de la alerta asociada (si existe)")
 * )
 */
    class Call extends Model {

        use HasFactory, SoftDeletes;
        
        protected $fillable = ['teleoperator_id', 'patient_id', 'call_type', 'type', 'call_time', 'title', 'description', 'alert_id'];
    
        public function teleoperator() {
            return $this->belongsTo(Teleoperator::class);
        }
    
        public function patient() {
            return $this->belongsTo(Patient::class);
        }
    
        public function alert() {
            return $this->belongsTo(Alert::class);
        }
    }
?>