<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\SoftDeletes;

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