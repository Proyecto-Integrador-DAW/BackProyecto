<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * @OA\Schema(
 *     schema="Teleoperator",
 *     description="Esquema del modelo Teleoperator",
 *     @OA\Property(property="id", type="integer", description="ID del teleoperador"),
 *     @OA\Property(property="name", type="string", description="Nombre del teleoperador"),
 *     @OA\Property(property="email", type="string", format="email", description="Correo electrónico del teleoperador"),
 *     @OA\Property(property="prefix", type="string", description="Prefijo del número de teléfono"),
 *     @OA\Property(property="phone_number", type="string", description="Número de teléfono del teleoperador"),
 *     @OA\Property(property="zone_id", type="integer", description="ID de la zona del teleoperador"),
 *     @OA\Property(property="hiring_date", type="string", format="date", description="Fecha de contratación"),
 *     @OA\Property(property="code", type="string", description="Código único del teleoperador"),
 *     @OA\Property(property="firing_date", type="string", format="date", nullable=true, description="Fecha de despido (puede ser nulo)")
 * )
 */
    class Teleoperator extends Model {

        use HasFactory, SoftDeletes;

        protected $fillable = ['name', 'email', 'prefix', 'phone_number', 'zone_id', 'hiring_date', 'code', 'password', 'firing_date'];

        protected $hidden = ['password'];

        public function zone() {
            return $this->belongsTo(Zone::class);
        }

        public function languages() {
            return $this->belongsToMany(Language::class, 'teleoperator_languages')->withTimestamps();
        }

        public function calls() {
            return $this->hasMany(Call::class);
        }

        protected static function booted() {
            static::created(function ($teleoperator) {
                User::create([
                    'name' => $teleoperator->name,
                    'email' => $teleoperator->email,
                    'password' => $teleoperator->password,
                    'code' => $teleoperator->code,
                    'role' => 'teleoperador'
                ]);
            });
        }
    }
?>