<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;

    class AlertType extends Model {

        use HasFactory, SoftDeletes;

        protected $fillable = ['name'];

        public function subtypes() {
            return $this->hasMany(AlertSubtype::class);
        }
    }
?>