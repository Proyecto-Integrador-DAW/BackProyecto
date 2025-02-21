<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * @OA\Schema(
 *     schema="Alert",
 *     description="Esquema del modelo Alert",
 *     @OA\Property(property="id", type="integer", description="ID de la alerta"),
 *     @OA\Property(property="alert_subtype_id", type="integer", description="ID del subtipo de alerta"),
 *     @OA\Property(property="title", type="string", description="Título de la alerta"),
 *     @OA\Property(property="description", type="string", description="Descripción de la alerta"),
 *     @OA\Property(property="frequency", type="string", description="Frecuencia de la alerta"),
 *     @OA\Property(property="days_of_week", type="array", @OA\Items(type="string"), description="Días de la semana en los que ocurre la alerta"),
 *     @OA\Property(property="zone_id", type="integer", description="ID de la zona relacionada con la alerta")
 * )
 */
    class Alert extends Model {

        use HasFactory, SoftDeletes;

        protected $fillable = ['alert_subtype_id', 'title', 'description', 'frequency', 'days_of_week', 'zone_id'];

        public function alertSubtype() {
            return $this->belongsTo(AlertSubtype::class, 'alert_subtype_id');
        }

        public function zone() {
            return $this->belongsTo(Zone::class);
        }
    }
?>