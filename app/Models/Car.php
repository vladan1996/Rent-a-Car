<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = [
        'registration_license',
        'brand',
        'model',
        'manufacture_date',
        'description',
        'category_id',
        'properties',
        'slug'
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }


    public function sluggable(){
        return [
            'slug' => [
                'source' => ['brand', 'model','registration_license'],
                'separator' => '_'
            ]
        ];
    }
}
