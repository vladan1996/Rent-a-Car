<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_license',
        'brand',
        'model',
        'manufacture_date',
        'description',
        'category_id',
        'properties'
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
