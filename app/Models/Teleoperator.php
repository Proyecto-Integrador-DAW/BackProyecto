<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;

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
    }
?>