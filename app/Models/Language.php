<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * @OA\Schema(
 *     schema="Language",
 *     description="Esquema del modelo Language",
 *     @OA\Property(property="id", type="integer", description="ID del idioma"),
 *     @OA\Property(property="name", type="string", description="Nombre del idioma")
 * )
 */
    class Language extends Model {
        
        use HasFactory, SoftDeletes;

        protected $fillable = ['name'];

        public function teleoperators() {
            return $this->belongsToMany(Teleoperator::class, 'teleoperator_languages');
        }
    }
?>