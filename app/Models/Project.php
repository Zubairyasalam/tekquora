<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'category',
        'description',
        'tech_tags',
        'image_1',
        'image_2',
        'sort_order'
    ];

    protected $casts = [
        'tech_tags' => 'array',
    ];
}
