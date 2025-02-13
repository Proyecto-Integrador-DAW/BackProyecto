<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Factories\HasFactory;

    class Language extends Model {
        
        use HasFactory;

        protected $fillable = ['name'];

        public function teleoperators() {
            return $this->belongsToMany(Teleoperator::class, 'teleoperator_languages');
        }
    }
?>