<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;

    class Call extends Model {

        use HasFactory, SoftDeletes;

        protected $fillable = ['date_time', 'operator_id', 'patient_id', 'description', 'call_type', 'type_id', 'alerts_id'];
    }
?>