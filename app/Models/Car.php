<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $table = 'students';
    protected $fillable = [
        'registration_license',
        'brand',
        'model',
        'manufature_date',
        'description',
        'category_id',
        'properties'
    ];
}
