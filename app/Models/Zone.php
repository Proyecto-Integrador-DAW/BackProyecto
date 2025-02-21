<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * @OA\Schema(
 *     schema="Zone",
 *     description="Esquema del modelo Zone",
 *     @OA\Property(property="id", type="integer", description="ID de la zona"),
 *     @OA\Property(property="city", type="string", description="Ciudad de la zona"),
 *     @OA\Property(property="zone", type="string", description="Nombre de la zona"),
 *     @OA\Property(property="created_at", type="string", format="date-time", description="Fecha de creación del registro"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", description="Fecha de actualización del registro"),
 *     @OA\Property(property="deleted_at", type="string", format="date-time", nullable=true, description="Fecha de eliminación del registro (soft delete)")
 * )
 */
    class Zone extends Model {

        use HasFactory, SoftDeletes;

        protected $fillable = ['city', 'zone'];

        public function patients() {
            return $this->hasMany(Patient::class, 'zone_id');
        }

        public function operators() {
            return $this->hasMany(Teleoperator::class, 'zone_id'); 
        }
    }
?>