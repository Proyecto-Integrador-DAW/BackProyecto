<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class AlertType extends Model
{
    use HasFactory;
    protected $fillable = ['description', 'category_id'];

    public function category()
{
    return $this->belongsTo(AlertCategory::class, 'category_id');
}
}
 