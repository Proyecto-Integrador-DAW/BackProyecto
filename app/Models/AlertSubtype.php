<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * @OA\Schema(
 *     schema="AlertSubtype",
 *     description="Esquema del modelo AlertSubtype",
 *     @OA\Property(property="id", type="integer", description="ID del subtipo de alerta"),
 *     @OA\Property(property="alert_type_id", type="integer", description="ID del tipo de alerta al que pertenece"),
 *     @OA\Property(property="name", type="string", description="Nombre del subtipo de alerta")
 * )
 */
    class AlertSubtype extends Model {

        use HasFactory, SoftDeletes;

        protected $fillable = ['alert_type_id', 'name'];

        public function alertType() {
            return $this->belongsTo(AlertType::class);
        }

        public function alerts() {
            return $this->hasMany(Alert::class);
        }
    }
?>