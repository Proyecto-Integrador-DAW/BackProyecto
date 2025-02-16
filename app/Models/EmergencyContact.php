<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\SoftDeletes;
    use Illuminate\Database\Eloquent\Model;

    class EmergencyContact extends Model {
        
        use HasFactory, SoftDeletes;

        protected $fillable = ['name', 'phone', 'relationship'];

        public function patients() {
            return $this->belongsToMany(Patient::class, 'patient_emergency_contact');
        }
    }
?>