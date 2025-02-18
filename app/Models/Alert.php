<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;

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