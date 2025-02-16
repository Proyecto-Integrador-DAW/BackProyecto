<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\SoftDeletes;

    class Language extends Model {
        
        use HasFactory, SoftDeletes;

        protected $fillable = ['name'];

        public function teleoperators() {
            return $this->belongsToMany(Teleoperator::class, 'teleoperator_languages');
        }
    }
?>