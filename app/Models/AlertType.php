<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * @OA\Schema(
 *     schema="AlertType",
 *     description="Esquema del modelo AlertType",
 *     @OA\Property(property="id", type="integer", description="ID del tipo de alerta"),
 *     @OA\Property(property="name", type="string", description="Nombre del tipo de alerta")
 * )
 */
    class AlertType extends Model {

        use HasFactory, SoftDeletes;

        protected $fillable = ['name'];

        public function subtypes() {
            return $this->hasMany(AlertSubtype::class);
        }
    }
?>