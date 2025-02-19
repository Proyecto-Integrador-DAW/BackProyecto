<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;

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