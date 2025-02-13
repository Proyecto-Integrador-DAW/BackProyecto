<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class WarningTypes extends Model
{
    use HasFactory;
    protected $fillable = ['description', 'category_id'];

    public function category()
{
    return $this->belongsTo(WarningCategories::class, 'category_id');
}
}
 