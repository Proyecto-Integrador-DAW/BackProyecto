<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;

    class Alert extends Model {

        use HasFactory, SoftDeletes;

        protected $fillable = ['description', 'type_id', 'start_date', 'end_date', 'periodicity', 'week_day'];

        public function type() {
            return $this->belongsTo(AlertType::class, 'type_id');
        }
    }
?>