<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TravelPosts extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'joomla_id',
        'title',
        'alias',
        'introtext',
         'publish_up',
        'images',
        'country',
        'city',
        'coordinates',
        'group_stories',
        'joomla_modified',
    ];

    protected $casts = [
        'publish_up' => 'datetime',
        'joomla_modified' => 'datetime',
    ];
}
