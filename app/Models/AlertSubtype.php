<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;

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