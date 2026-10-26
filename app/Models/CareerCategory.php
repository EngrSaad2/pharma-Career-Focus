<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CareerCategory extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'icon',
        'description',
        'sort_order',
    ];

    public function careerPaths()
    {
        return $this->hasMany(CareerPath::class, 'category_id')->orderBy('sort_order');
    }
}
